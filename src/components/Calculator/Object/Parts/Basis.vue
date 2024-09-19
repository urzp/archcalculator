<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj title="HOAI version" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Planning object" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee zone" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee rate" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Eligible costs" :data="Basis" input_type @edit_price="val=>updateData(val, 'Eligible costs')"></ItemPartObj>
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
        EventBus.on('edit:price', (data)=>{updateData(val, item_name)})
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
        },
        updateData(val, item_name){
            this.Basis[item_name].value = val
        }
    }
}
</script>

<style scoped>

</style>