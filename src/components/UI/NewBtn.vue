<template>
    <div class="new-btn">
        <img src="@/assets/icons/btn_new/main.svg" alt="">
        <slot/>
    </div>
    
</template>

<script>
export default{
    name: 'NewButton',
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
    .new-btn{
        width: v-bind(width);
        height: v-bind(heigth);
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
        column-gap: 10px;
        align-items: center;
        justify-content: center;
        border: solid 1px #9A9A9A ;
        border-radius: 5px;
        cursor: pointer;
    }
</style>