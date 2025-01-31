<template>
    <div class="text-btn" :class="{open_button:open}">
        <img v-if="open" src="@/assets/icons/btn_left/main.svg" alt="">
        <img v-else src="@/assets/icons/btn_right/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'ButtonSiteBar',
    props:{
        width:{
            type:String,
            default: '55px',
        },
        height:{
            type:String,
            default: '45px',
        },
        open: Boolean,
    }
}
</script>

<style scoped>
    .text-btn{
        position: absolute;
        top:10px;
        right: -75px;
        width: v-bind(width);
        height: v-bind(height);
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
        column-gap: 10px;
        align-items: center;
        justify-content: center;
        border: solid 1px #9A9A9A ;
        border-radius: 5px;
        cursor: pointer;
        background-color: #F5F5F5;
    }

    .open_button{
        right: 10px;
        background-color: #EAEAEA!important;
    }
</style>