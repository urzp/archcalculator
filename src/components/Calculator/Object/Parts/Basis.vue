<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj v-for="item in data.list" :key="item.name" :data="item"></ItemPartObj>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse' :data="data.Total"/>    
</template>

<script>

export default{
    name: 'Basis',
    data(){
        return{
            collapse:false,
        }
    },
    props:{
        data: Object,
    },
}
</script>

<style scoped>

</style>