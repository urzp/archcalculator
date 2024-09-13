<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <div class="SubObjectList" :class="{collapse}">
        <ItemSubObj title="HOAI version"/>
        <ItemSubObj title="Planning object"/>
        <ItemSubObj title="Fee zone"/>
    </div>
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
    .collapse{
        height: 0;
        display: none;
    }
</style>