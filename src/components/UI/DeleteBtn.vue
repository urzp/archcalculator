<template>
    <div class="delete-btn">
        <img src="@/assets/icons/btn_delete/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'DeleteButton',
}
</script>

<style scoped>
    .delete-btn{
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