<template>
    <PartObjectTitle name="Base services" @open_close="(val)=>{collapse=!val}"/>
    <div class="SubObjectList" :class="{collapse}">
        <ItemSubObj title="Basic research"/>
        <ItemSubObj title="Design planning"/>
        <ItemSubObj title="Pre-planning"/>
    </div>
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
    .collapse{
        height: 0;
        display: none;
    }
</style>