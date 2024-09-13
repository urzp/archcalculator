<template>
    <div class="item-Part-obj">
        <div class="title">{{ title }}</div>
    </div>
</template>

<script>
export  default{
    name: 'ItemPartObj',
    data(){
        return{
            title:'',
            collapse:true
        }
    },
    props:{
        title:String,
    },
}
</script>

<style scoped>
    .item-Part-obj{
        display: flex;
        height: 35px;
    }
    .title{
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
</style>