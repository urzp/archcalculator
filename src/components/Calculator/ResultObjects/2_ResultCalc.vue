<template>
    <div class="total-calc" :class="{collapse}">
        <Titile_Result  @switch_tg="(val)=>{collapse = !val}"/>
        <Toggle :collapse="collapse">
            <AdditionalServices/>
            <ExtraCosts/>
            <Summary/>
            <RestHonorar v-if="isBill"/>
        </Toggle>
        <Total_Result :collapse="collapse" />
    </div> 
</template>

<script>
import { Project } from "@/servis/projectData"
export default{
    name: 'ResultCalc',
    async mounted(){

    },
    data(){
        return{
            collapse: false,
        }
    },
    computed:{
        isBill(){
            let result = false;
            if(!!Project&&!!Project.project&&!!Project.project.status&&Project.project.status=='bill') result = true
            return result
        }
    },
    methods:{
    },

}
</script>

<style scoped>
    .total-calc{
        margin-top: 50px;
        margin-bottom: 30px;
        
    }

    .collapse{
        margin-bottom:0px;
    }

    .item{
        min-height: 100px;
    }
</style>