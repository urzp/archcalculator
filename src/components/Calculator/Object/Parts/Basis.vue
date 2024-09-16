<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj title="HOAI version" :data="Basis" >
            <!-- <Select_List :list="List_HOAT_v" @selected="(val)=>{selectItem('HOAI version',val)}" /> -->
        </ItemPartObj>
        <!-- <ItemPartObj title="Planning object" :data="Basis">
            <Select_List :list="List_Planing_Object"/>
        </ItemPartObj>
        <ItemPartObj title="Fee zone" :data="Basis">
            <Select_List :list="List_Fee_Zone"/>
        </ItemPartObj>
        <ItemPartObj title="Fee rate" :data="Basis">
        </ItemPartObj> -->
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse'/>    
</template>

<script>
import { getData } from '@/servis/getData.js'
export default{
    name: 'Basis',
    async mounted(){
        let data = getData()
        this.Basis = data.Basis
        this.List_HOAT_v = data.Basis["HOAI version"].list
        this.List_Planing_Object = data.Basis["Planning object"].list
        this.List_Fee_Zone = data.Basis["Fee zone"].list
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