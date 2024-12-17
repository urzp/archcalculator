<template>
    <div class="close-btn">
        <img src="@/assets/icons/btn_update/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'UpdateBtn',
    props:{
        width:{
            type:String,
            default: '55px',
        },
        height:{
            type:String,
            default: '45px',
        }
    }
}
</script>

<style scoped>
    .close-btn{
        width: v-bind(width);
        height: v-bind(height);
        display: flex;
        align-items: center;
        justify-content: center;
        border: solid 1px #9A9A9A ;
        border-radius: 5px;
        cursor: pointer;
    }
</style>