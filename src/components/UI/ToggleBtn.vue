<template>
    <div class="toggle_btn"></div>
</template>

<script>
export default{
    name: 'ToggleButton',
}
</script>

<style scoped>
    .toggle_btn{
        width: 12px;
        height: 10px;
        background-image: url('@/assets/icons/toggle_btn/opend.svg');
        background-repeat: no-repeat;
        background-position: center;
        cursor: pointer;
    }
    .toggle_btn.closed{
        background-image: url('@/assets/icons/toggle_btn/closed.svg');
    }
</style>

