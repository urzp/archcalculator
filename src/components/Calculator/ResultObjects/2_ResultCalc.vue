<template>
    <div class="total-calc" :class="{collapse}">
        <Titile_Result  @switch_tg="(val)=>{collapse = !val}"/>
        <Toggle :collapse="collapse">
            <AdditionalServices/>
            <ExtraCosts/>
            <Summary/>
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