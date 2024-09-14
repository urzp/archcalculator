<template>
    <PartObjectTitle name="Base services" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj title="Basic research"/>
        <ItemPartObj title="Design planning"/>
        <ItemPartObj title="Pre-planning"/>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse'/>    
</template>

<script>
export default{
    name: 'BaseServis',
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