<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <HOAI_version/>
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