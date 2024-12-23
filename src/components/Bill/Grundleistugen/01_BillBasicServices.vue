<template>
    <div class="honorar item_base_servis light-text">
        <div class="wrap_part">
            <div class="number">1.</div>
            <div class="title">Honorarzone und Honorarsatz</div>
        </div>
        <div class="wrap_part">
            <div class="value">
                <InputText_Bill :value="honorar_zone" width="50px" alight_edit="center"
                @submit_event="value=>update_value(value,'honorar_zone')" 
                @setDefault="set_default('honorar_zone')"/>
            </div>
            <div class="value">
                <InputText_Bill :value="honorar_satz" width="150px" alight_edit="center"
                @submit_event="value=>update_value(value,'honorar_satz')" 
                @setDefault="set_default('honorar_satz')"/>
            </div>
        </div>
    </div>
    <div class="honorar item_base_servis light-text">
        <div class="wrap_part">
            <div class="number">2.</div>
            <div class="title">Anrechenbaren Kosten</div>
        </div>
        <div class="value bold-text" >
            <PriceInputBill :value ="costs" @editPrice="newValue=>update_value(newValue, 'costs')" @setDefault="set_default('costs')"/>
        </div>
    </div>
    <div class="honorar item_base_servis light-text">
        <div class="wrap_part">
            <div class="number">3.</div>
            <div class="title">Rechnerisches Gesamthonorar LPH 1-9</div>
        </div>
        <div class="value bold-text">
            <PriceInputBill :value ="total" @editPrice="newValue=>update_value(newValue, 'total')" @setDefault="set_default('total')"/>
        </div>
    </div>
</template>

<script>
import { Bills, saveBill, getCosts_ById } from '@/servis/projectBill.js'
import { Project } from '@/servis/projectData.js'
export default{
    name: 'BillBasicServices',
    props:{
        id_bill:[String,Number],
        honorar_object: Object,
    },
    computed:{
        honorar_zone(){
            let result = '-'
            if(!!this.honorar_object&&!!this.honorar_object.honorar_zone) result = this.honorar_object.honorar_zone
            return result
        },
        honorar_satz(){
            let result = '-'
            if(!!this.honorar_object&&this.honorar_object.honorar_satz) result = this.honorar_object.honorar_satz
            return result
        },
        costs(){
            let result = 0
            if(!!this.honorar_object&&this.honorar_object.costs) result = this.honorar_object.costs
            return result
        },
        total(){
            let result = 0
            if(!!this.honorar_object&&this.honorar_object.honorar_total) result = this.honorar_object.honorar_total
            return result          
        }
    },
    methods:{
        update_value(value, name_value){
            if(name_value=='honorar_zone') this.honorar_object.honorar_zone = value
            if(name_value=='honorar_satz') this.honorar_object.honorar_satz = value
            if(name_value=='costs') this.honorar_object.costs = value
            if(name_value=='total') this.honorar_object.honorar_total = value
            saveBill(this.id_bill)
        },
        set_default(name_value){
            if(name_value=='honorar_zone') this.honorar_object.honorar_zone = Project.objects.find(item=>item.id=this.honorar_object.id).honorarLevel.number
            if(name_value=='honorar_satz') this.honorar_object.honorar_satz = Project.objects.find(item=>item.id=this.honorar_object.id).HonorarRate.value
            if(name_value=='honorar_satz') this.honorar_object.honorar_satz = Project.objects.find(item=>item.id=this.honorar_object.id).HonorarRate.value
            if(name_value=='costs') this.honorar_object.costs = getCosts_ById(this.honorar_object.id)
            if(name_value=='total') this.honorar_object.honorar_total = Project.objects.find(item=>item.id=this.honorar_object.id).honorar_total
            saveBill(this.id_bill)
        },
    }

}
</script>

<style scoped>

    .honorar{
        margin-right: 12%;
    }

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
        column-gap: 15px;
        justify-content: space-between;
    }

    .value{
        text-align: right;
    }
</style>

