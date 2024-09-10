<template>
    <div class="close-btn">
        <img src="@/assets/icons/btn_close/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'CloseButton',
}
</script>

<style scoped>
    .close-btn{
        width: 55px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: solid 1px #9A9A9A ;
        border-radius: 5px;
        cursor: pointer;
    }
</style>