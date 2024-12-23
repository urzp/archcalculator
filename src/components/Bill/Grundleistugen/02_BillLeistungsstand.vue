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
                    <InputNumber
                    :value = "selectPercent(item)" paramSymb=" %" 
                    @editValue = "procent=>update_value(procent, 'user_percent', item.id)"
                    @setDefault="set_default('user_percent', item.id)"/>
                </div>
                <div class="colum colum_3">
                    <InputNumber noUpdate
                    :value = "item.done" paramSymb=" %"
                    @editValue = "procent=>update_value(procent, 'done', item.id)"/>
                </div>
                <div class="colum colum_4">
                    <InputNumber noUpdate
                    :value = "item.factor" float="2"
                    @editValue = "value=>update_value(value, 'factor', item.id)"/>
                </div>
                <div class="colum colum_5">
                    <PriceBill :value="item.total"/>
                </div>
                <div class="colum colum_6"></div>
            </div>
            <div class="total item_list bold-text">
                <div class="colum colum_1">Summe as {{ list.length }}</div>
                <div class="colum colum_2">    
                    {{ total_percent }}%                
                </div>
                <div class="colum colum_3">
                    {{ total_done }}%
                </div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"><PriceBill :value="total_price" /></div>
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
    watch:{
        honorar(){
            this.calc_totals()
            saveBill(this.id_bill)
        }
    },
    computed:{
        list(){
            let result = []
            if(!!this.honorar_object&&!!this.honorar_object.stages) result = this.honorar_object.stages
            return result
        },   
        honorar(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.honorar_total) result = this.honorar_object.honorar_total
            return result
        },
        total_percent(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.stages_total&&!!this.honorar_object.stages_total.percent) result = this.honorar_object.stages_total.percent
            return result
        },
        total_done(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.stages_total&&!!this.honorar_object.stages_total.done) result = this.honorar_object.stages_total.done
            return result
        },
        total_price(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.stages_total&&!!this.honorar_object.stages_total.price) result = this.honorar_object.stages_total.price
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
            if(name_value=='factor') element.factor = value
            this.calc_totals()
            saveBill(this.id_bill)
        },
        set_default(name_value, id){
            let element = this.honorar_object.stages.find(item=>item.id==id)
            if(name_value=='user_percent') element.user_percent = ''
            this.calc_totals()
            saveBill(this.id_bill)
        },
        calc_totals(){
            let summ_price = 0 
            let summ_done = 0
            let summ_percent = 0
            let honorar = this.honorar_object.honorar_total
            this.honorar_object.stages.forEach(item=>{
                item.total = Number(honorar) * (Number(item.done)/100) * item.factor
                summ_price = summ_price + item.total
                summ_done = summ_done + Number(item.done)
                let selectPercent = !!item.user_percent?Number(item.user_percent):Number(item.percent)
                summ_percent = summ_percent + selectPercent
            })
            this.honorar_object.stages_total.done = summ_done
            this.honorar_object.stages_total.percent = summ_percent
            this.honorar_object.stages_total.price = summ_price
            this.honorar_object.stagesTotal = summ_price
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
        width: 500px;
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
        text-align: center;
    }
</style>
