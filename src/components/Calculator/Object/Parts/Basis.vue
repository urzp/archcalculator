<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <ItemPartObj title="HOAI version" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Planning object" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee zone" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Fee rate" :data="Basis"></ItemPartObj>
        <ItemPartObj title="Eligible costs" :data="Basis" input_type></ItemPartObj>
        <ItemPartObj title="Fee according to fee table" :data="Basis" ></ItemPartObj>
        <ItemPartObj title="Surcharge" :data="Basis" input_type ></ItemPartObj>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse' :data="Basis['Total']"/>    
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
        name:String,
        Basis: Object,
    },
}
</script>

<style scoped>

</style>