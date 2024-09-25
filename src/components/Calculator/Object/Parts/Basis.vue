<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj title="HOAI version" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Planning object" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee zone" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee rate" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Eligible costs" :data="Basis" input_type></ItemPartObj>
        <ItemPartObj title="Fee according to fee table" :data="Basis" ></ItemPartObj>
        <ItemPartObj title="Surcharge" :data="Basis" input_type @edit_percent="val=>updateData(val, 'Surcharge')"></ItemPartObj>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse' :data="Basis['Total']"/>    
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { getData } from '@/servis/getData.js'
export default{
    name: 'Basis',
    async mounted(){
        let data = getData()
        this.Basis = data.Basis
        EventBus.on('SelectList:selected', (data)=>{this.selectItem(data.name_list, data.value)})
        EventBus.on('edit:input', (data)=>{this.updateData( data.value, data.name_value)})
        EventBus.on('edit:input_detals', (data)=>{this.updateDataDetals( data.name_value, data.id_item, data.value )})
        EventBus.on('edit:update_user_title', (data)=>{this.updateDataDetals( data.name_value, data.id_item, data.value, 'user_title' )})
        this.calculate()
    },
    data(){
        return{
            collapse:false,
            Basis:{},
        }
    },
    props:{
        name:String,
    },
    methods:{
        selectItem(item, value){
            this.Basis[item].value = value
            if(item == "Fee zone") this.Basis["Fee zone"].detail_input.use = false
            this.calculate()
        },
        updateData(val, item_name){
            if(!val||!item_name) return false
            this.Basis[item_name].value = val
            if(!!this.Basis[item_name].detail_input) this.Basis[item_name].detail_input.use = false
            this.calculate()
        },
        updateDataDetals( item_name, id_item, val, name_value = 'value' ){
            let detals = this.Basis[item_name].detail_input
            detals.use = true
            let el = detals.list.find(item => item.id == id_item);
            el[name_value] = val
            this.calculate()
        },
        calculate(){
           let Surcharge = this.Basis['Surcharge']
           Surcharge.price = Surcharge.value * 0.01 * this.Basis["Fee according to fee table"].value
           this.calculate_detals("Fee zone")
           this.calculate_detals("Eligible costs")
           this.calculate_fee_table_value()
           this.Basis['Total'].value = this.Basis["Fee according to fee table"].value + this.Basis["Surcharge"].price
        },
        calculate_detals(item_name){
            if (!item_name) return false
            let detals = this.Basis[item_name].detail_input 
            let total = 0
            detals.list.forEach(element => {
                let val = element.value==''?element.def_value:element.value
                total = total + Number(val)
            });
            detals.total.value = total
            if(item_name=="Fee zone"){
                let equivalent = detals.equivalents.find(item => total < item.value);
                detals.total.equivalent = equivalent.name
                if(detals.use) this.Basis[item_name].value = equivalent.name
            }
            if(item_name=="Eligible costs"){
                if(detals.use) this.Basis[item_name].value = detals.total.value
            }
        },
        calculate_fee_table_value(){
            let Fee_Table = this.Basis["Fee according to fee table"].detail_input
            let min = Fee_Table.current.min_fee
            let max = Fee_Table.current.max_fee
            let name_val = this.Basis["Fee rate"].value
            let list = this.Basis["Fee rate"].list
            let fee_rate_procent = list.find(item => item.val == name_val).percent
            let fee_value = min + (max-min) * (fee_rate_procent/100)
            this.Basis["Fee according to fee table"].value = fee_value
        },
    }
}
</script>

<style scoped>

</style>