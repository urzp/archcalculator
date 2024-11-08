<template>
    <div class="title-object">
        <ToggleButton @switch_tg="(val)=>{this.$emit('switch_tg', val) }"/>
        <div class="name">Object A</div>
        <CloseButton class="align-left"/>
    </div>   
</template>

<script>
export default{
    name: 'Titile_Object',
    emits: ['switch_tg'],
}
</script>

<style scoped>
    .title-object{
        display: flex;
        align-items: center;
        column-gap: 15px;
        margin-left: 30px;
    }
    .title-object .name{
        font-family: 'Raleway-Light';
        font-size: 26px;
    }
    .align-left{
        margin-left: auto;
    }
</style>