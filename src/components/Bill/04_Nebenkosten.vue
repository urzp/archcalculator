<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">III.<span>Nebenkosten</span></div>
        </div>
        <div class="list">
            <div class="content item_list light-text" v-for="item in list" :key="item.id">
                <div class="colum colum_1">{{ !item.title?'Leistung eingeben':item.title }}</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3">
                    <InputNumber
                    :value = "item.rate" float="2"
                    @editValue = "value=>update_value(value, 'rate', item.id)"
                    @setDefault="set_default('rate', item.id)"/>
                </div>
                <div class="colum colum_4">
                    <InputNumber
                    :value = "item.price_rate" paramSymb=" €" float="2"
                    @editValue = "value=>update_value(value, 'price_rate', item.id)"
                    @setDefault="set_default('price_rate', item.id)"/>              
                </div>
                <div class="colum colum_5">
                    <Price :value="item.total" 
                    font_size_unit="18px"
                    font_family="Raleway-Light"/>
                </div>
                <div class="colum colum_6"></div>
            </div>
            <div class="total item_list bold-text" v-if="list.length>0">
                <div class="colum colum_1">Summe as {{ list.length }}</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5">
                    <Price :value="total_price" font_size_unit="18px" font_family="Raleway-Medium"/>
                </div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>  
</template>

<script>
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill } from '@/servis/projectBill.js'
export default{
    name: 'Nebenkosten',
    data(){
        return{

        }
    },
    props:{
        bill_item:[Number, String]
    },
    computed:{
        actualBill(){
            let result = {}
            if(!!Bills&&Bills.length>0) result = Bills[this.bill_item]
            return result
        },
        list(){
            let result = []
            if(!!this.actualBill&&!!this.actualBill.extraCosts) result=this.actualBill.extraCosts
            return result
        },
        total_price(){
            let result = 0
            if(!!this.actualBill&&!!this.actualBill.totalExtraCosts) result=this.actualBill.totalExtraCosts
            return result
        }
    },
    methods:{
        update_value(value, name_value, id){
            let element = this.actualBill.extraCosts.find(item=>item.id==id)
            if(name_value=='rate') element.rate = value
            if(name_value=='price_rate') element.price_rate = value
            this.calc_totals()
            saveBill(this.id_bill)
        },
        set_default(name_value, id){
            let element = this.actualBill.extraCosts.find(item=>item.id==id)
            let element_project = Project.project.ExtraCosts.find(item=>item.id==id)
            if(name_value=='rate') element.rate = element_project.rate
            if(name_value=='price_rate') element.price_rate = element_project.price_rate
            this.calc_totals()
            saveBill(this.id_bill)
        },
        calc_totals(){
            let summ_price = 0 
            this.actualBill.extraCosts.forEach(item=>{
                item.total = Number(item.rate) * (Number(item.price_rate))
                summ_price = summ_price + item.total
            })
            this.actualBill.totalExtraCosts = summ_price
        }
    }

}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
    }


    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .header_item{
        border-top: 1px solid #999;
        border-bottom: 1px solid #999;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .title span{
        margin-left: 10px;
    }

    .list{
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .header{
        border-bottom: 1px solid #999;
        margin-bottom: 5px;
    }

    .item_list{
        display: flex;
    }

    .colum{
        display: flex;
        justify-content: center;
    }

    .colum_1{
        width: 570px;
        display: flex;
        justify-content: flex-start;
    }
    .colum_2{
        width: 11%;
    }
    .colum_3{
        width: 11%;
    }
    .colum_4{
        width: 11%;
    }
    .colum_5{
        width: 12%;
    }
    .colum_6{
        width: 12%;
    }

    .content .colum_1{
        font-size: 16px;
    }

    .content .colum_2 {
        font-size: 16px;
    }

    .colum_5{
        display: flex;
        justify-content: flex-end;
    }

    .total .colum_2, .total .colum_3{
        padding-right: 28px;
        text-align: right;
    }

</style>