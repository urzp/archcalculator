<template>
    <div class="new-btn">
        <img src="@/assets/icons/btn_calendar/main.svg" alt="">
        <slot/>
    </div>
    
</template>

<script>
export default{
    name: 'CalendatBtn',
    props:{
        width:{
            type:String,
            default: '55px',
        },
        height:{
            type:String,
            default: '45px',
        },
        width_img:{
            type:String,
            default: '15px',
        }
    }
}
</script>

<style scoped>
    .new-btn{
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
        background-color: #fff!important;
    }

    .new-btn img{
        width: v-bind(width_img);
    }
</style>