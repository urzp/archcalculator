<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent>
        <ItemPartObj title="HOAI version"/>
        <ItemPartObj title="Planning object"/>
        <ItemPartObj title="Fee zone"/>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse'/>    
</template>

<script>
export default{
    name: 'Basis',
    data(){
        return{
            collapse:false
        }
    },
    props:{
        name:String,
    },
}
</script>

<style scoped>

</style>