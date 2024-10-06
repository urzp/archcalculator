<template>
    <div class="close-btn">
        <img src="@/assets/icons/btn_close/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'CloseButton',
    props:{
        width:{
            type:String,
            default: '55px',
        },
        heigth:{
            type:String,
            default: '45px',
        }
    }
}
</script>

<style scoped>
    .close-btn{
        min-width: v-bind(width);
        min-height: v-bind(heigth);
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: solid 1px #9A9A9A ;
        border-radius: 5px;
        cursor: pointer;
    }
</style>