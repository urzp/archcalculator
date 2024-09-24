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
    <PartObjectTotal :collapse = 'collapse'/>    
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
            this.calculate()
        },
        updateDataDetals( item_name, id_item, val ){
            let detals = this.Basis[item_name].detail_input
            detals.use = true
            let el = detals.list.find(item => item.id == id_item);
            el.value = val
            this.calculate()
        },
        calculate(){
           let Surcharge = this.Basis['Surcharge']
           Surcharge.price = Surcharge.value * 0.01 * this.Basis["Fee according to fee table"].value
           this.calculate_free_zone()
        },
        calculate_free_zone(){
            let detals = this.Basis["Fee zone"].detail_input 
            let total = 0
            detals.list.forEach(element => {
                let val = element.value==''?element.def_value:element.value
                total = total + Number(val)
            });
            detals.total.value = total
            let equivalent = detals.equivalents.find(item => total < item.value);
            detals.total.equivalent = equivalent.name
            if(detals.use) this.Basis["Fee zone"].value = equivalent.name
        }
    }
}
</script>

<style scoped>

</style>