<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent>
        <ItemPartObj title="HOAI version" :data="data" ><SelList_HOAT_Ver/></ItemPartObj>
        <ItemPartObj title="Planning object" :data="data"></ItemPartObj>
        <ItemPartObj title="Fee zone" :data="data"></ItemPartObj>
        <ItemPartObj title="Fee rate" :data="data"></ItemPartObj>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse'/>    
</template>

<script>
export default{
    name: 'Basis',
    data(){
        return{
            collapse:false,
            data:{
                "HOAI version": 2021,
                "Planning object":'§34G Buildings',
                "Fee zone":'III',
                "Fee rate":'Middle set',
            }
        }
    },
    props:{
        name:String,
    },
}
</script>

<style scoped>

</style>