<template>
    <PartObjectTitle name="Base services" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj v-for="item in data.list" :key="item.name" :data="item"></ItemPartObj>
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
        data: Object,
    },
}
</script>

<style scoped>

</style>