<template>
    <SubObjectTitle :name="name" @open_close="(val)=>{collapse=!val}"/>
    <div class="SubObjectList" :class="{collapse}">
        <div class="item">HOAI version</div>
        <div class="item">Planning object</div>
        <div class="item">Fee zone</div>
    </div>
    <SubObjectTotal :collapse = 'collapse'/>    
</template>

<script>
export default{
    name: 'SubObject',
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