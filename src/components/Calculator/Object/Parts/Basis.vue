<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj title="HOAI version" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Planning object" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee zone" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee rate" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Eligible costs" :data="Basis"></ItemPartObj>
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
        this.List_HOAT_v = data.Basis["HOAI version"].list
        this.List_Planing_Object = data.Basis["Planning object"].list
        this.List_Fee_Zone = data.Basis["Fee zone"].list

        EventBus.on('SelectList:selected', (data)=>{this.selectItem(data.name_list, data.value)})
    },
    data(){
        return{
            collapse:false,
            Basis:{},
            List_HOAT_v:[],
            List_Planing_Object:[],
            List_Fee_Zone:[],
        }
    },
    props:{
        name:String,
    },
    methods:{
        selectItem(item, value){
            this.Basis[item].value = value
        }
    }
}
</script>

<style scoped>

</style>