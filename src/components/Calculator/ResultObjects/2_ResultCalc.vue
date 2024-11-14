<template>
    <div class="total-calc" :class="{collapse}">
        <Titile_Result  @switch_tg="(val)=>{collapse = !val}"/>
        <Toggle :collapse="collapse">
            <AdditionalServices :project_id="project_id"/>
            <ExtraCosts :project_id="project_id" />
            <Summary  :project_id="project_id" />
        </Toggle>
        <Total_Result :collapse="collapse" />
    </div> 
</template>

<script>
export default{
    name: 'ResultCalc',
    async mounted(){

    },
    data(){
        return{
            collapse: false,
        }
    },
    props:{
        loaded:Boolean,
        project_id:String,
    },
    methods:{
    }
}
</script>

<style scoped>
    .total-calc{
        margin-top: 50px;
        margin-bottom: 90px;
        
    }

    .collapse{
        margin-bottom:0px;
    }

    .item{
        min-height: 100px;
    }
</style>