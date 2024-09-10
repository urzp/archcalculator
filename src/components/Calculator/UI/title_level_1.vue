<template>
    <div class="title-level-1">
        <ToggleButton/>
        <div class="title">{{ name }}</div>
    </div>
    <div class="line"></div>
</template>


<script>
export default{
    name: 'Title_level_1',
    props:{
        name:String,
    },
}
</script>


<style scoped>
    .title-level-1{
        margin-top: 30px;
        display: flex;
        column-gap: 15px;
        align-items: center;
        border-bottom: solid 1px #CFCFCF;
        padding-bottom: 30px;
        margin-bottom: 25px;
    }
    .title-level-1 .title{
        font-family: 'Raleway-Medium';
        font-size: 24px;
        color: #464646;
    }
    .line{
        position: relative;
        top: -26px;
        left: 0px;
        width: 200px;
        height: 1px;
        content: ' ';
        background-color: #000000;
    }
</style>