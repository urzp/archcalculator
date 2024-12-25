<template>
    <div class="down-btn">
        <img src="@/assets/icons/btn_down/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'DownButton',
    props:{
        width:{
            type:String,
            default: '55px',
        },
        heigth:{
            type:String,
            default: '45px',
        },
        height_img:{
            type:String,
            default: '12px',
        },
    }
}
</script>

<style scoped>
    .down-btn{
        min-width: v-bind(width);
        min-height: v-bind(heigth);
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: solid 1px #9A9A9A ;
        background-color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .down-btn img{
        height: v-bind(height_img);
    }
</style>