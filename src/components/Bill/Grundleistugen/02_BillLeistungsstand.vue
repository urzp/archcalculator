<template>
    <div class="honorar item_base_servis light-text">
        <div class="titile_item wrap_part">
            <div class="number">4.</div>
            <div class="title">Ermittlung Leistungsstand</div>
        </div>
        <div class="list">
            <div class="header item_list">
                <div class="colum colum_1">Leistungsphase</div>
                <div class="colum colum_2">beauftragt</div>
                <div class="colum colum_3">geleistet</div>
                <div class="colum colum_4">Faktor</div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="content item_list" v-for="item in list" :key="item.id">
                <div class="colum colum_1">{{ item.name }}</div>
                <div class="colum colum_2">
                    <Percent_Bill
                    :value = "selectPercent(item)" 
                    @edit_value = "procent=>update_value(procent, 'user_percent', item.id)"
                    @setDefault="set_default('user_percent', item.id)"/>
                </div>
                <div class="colum colum_3">
                    <Percent_Bill noUpdate
                    :value = "item.done" 
                    @edit_value = "procent=>update_value(procent, 'done', item.id)"/>
                </div>
                <div class="colum colum_4">{{ item.factor }}</div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="total item_list bold-text">
                <div class="colum colum_1">Summe</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bills, saveBill, getCosts_ById } from '@/servis/projectBill.js'
export default{
    name: 'BillLeistungsstand',
    data(){
        return{

        }
    },
    props:{
        id_bill:[String,Number],
        honorar_object: Object,
    },
    computed:{
        list(){
            let result = []
            if(!!this.honorar_object&&!!this.honorar_object.stages) result = this.honorar_object.stages
            return result
        }        
    },
    methods:{
        selectPercent(item){
            if(item.user_percent!='') return item.user_percent
            return item.percent
        },
        update_value(value, name_value, id){
            let element = this.honorar_object.stages.find(item=>item.id==id)
            if(name_value=='user_percent') element.user_percent = value
            if(name_value=='done') element.done = value
            saveBill(this.id_bill)
        },
        set_default(name_value, id){
            let element = this.honorar_object.stages.find(item=>item.id==id)
            if(name_value=='user_percent') element.user_percent = ''
            saveBill(this.id_bill)
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
</style>
