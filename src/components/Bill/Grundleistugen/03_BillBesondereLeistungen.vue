<template>
    <div class="honorar item_base_servis light-text" v-if="list.length>0">
        <div class="titile_item wrap_part">
            <div class="number">5.</div>
            <div class="title">Besondere Leistungen</div>
        </div>
        <div class="list">
            <div class="header item_list">
                <div class="colum colum_1">Sonderleistungen</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="content item_list" v-for="item in list" :key="item.id">
                <div class="colum colum_1">{{ !item.title?'Leistung eingeben':item.title }}</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3">
                    <InputNumber
                    :value = "item.percent" paramSymb=" %"
                    @editValue = "procent=>update_value(procent, 'user_percent', item.id)"
                    @setDefault="set_default('user_percent', item.id)"/>
                </div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5">
                    <PriceBill :value="item.total" />
                </div>
                <div class="colum colum_6"></div>
            </div>
            <div class="total item_list bold-text">
                <div class="colum colum_1">Summe as {{ list.length }}</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5">
                    <PriceBill :value="total_price" />
                </div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill, getCosts_ById } from '@/servis/projectBill.js'
export default{
    name: 'BillBesondereLeistungen',
    data(){
        return{

        }
    },
    props:{
        id_bill:[String,Number],
        honorar_object: Object,
    },
    watch:{
        honorar(){
            this.calc_totals()
            saveBill(this.id_bill)
        }
    },
    computed:{
        list(){
            let result = []
            if(!!this.honorar_object&&!!this.honorar_object.stagesExtra) result = this.honorar_object.stagesExtra
            return result
        },   
        total_price(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.stagesExtraTotal) result = this.honorar_object.stagesExtraTotal
            return result
        },
        honorar(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.honorar_total) result = this.honorar_object.honorar_total
            return result
        },

    },
    methods:{
        update_value(value, name_value, id){
            let element = this.honorar_object.stagesExtra.find(item=>item.id==id)
            if(name_value=='user_percent') element.percent = value
            this.calc_totals()
            saveBill(this.id_bill)
        },
        set_default(name_value, id){
            let element = this.honorar_object.stagesExtra.find(item=>item.id==id)
            let element_project = Project.objects.find(item=>item.id=this.honorar_object.id).specialServices
            if(name_value=='user_percent') element.percent = element_project.find(item=>item.id==id).percent
            this.calc_totals()
            saveBill(this.id_bill)
        },
        calc_totals(){
            let summ_price = 0 
            let honorar = this.honorar_object.honorar_total
            this.honorar_object.stagesExtra.forEach(item=>{
                item.total = Number(honorar) * (Number(item.percent)/100)
                summ_price = summ_price + item.total
            })
            this.honorar_object.stagesExtraTotal = summ_price
        }
    }

}
</script>



<style scoped>

.light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .wrap_part{
        display: flex;
        column-gap: 15px;
    }

    .item_base_servis{
        display: flex;
        flex-direction: column;
        column-gap: 15px;
        justify-content: space-between;
    }

    .list{
        margin-top: 20px;
        margin-left: 30px;
        margin-bottom: 20px;
    }

    .header{
        border-bottom: 1px solid #999;
        margin-bottom: 5px;
    }

    .total{
        border-bottom: 1px solid #999;
        margin-bottom: 5px;
    }

    .item_list{
        display: flex;
    }

    .colum_1{
        width: 43%;
    }
    .colum_2{
        width: 11%;
        text-align: center;
    }
    .colum_3{
        width: 11%;
        text-align: center;
    }
    .colum_4{
        width: 11%;
        text-align: center;
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
