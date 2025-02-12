<template>
    <Title_SubObject :name="text.RestHonorar" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <RestTotalHonorar :value="10000"/>
        <BillsPayments :value="5000"/>
        <CalcRestHonorar :value="5000" />
    </Content_PartObject>
</template>

<script>
export default{
    name:'RestHonorar',
    data(){
        return{
            collapse:false,
            text:{
                RestHonorar: text.Calc.RestHonorar,
            }
        }
    }
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