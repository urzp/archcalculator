<template>
    <div class="object-calc">
        <Toggle>
        <div class="title-object">
            <ToggleButton/>
            <div class="name">Object A</div>
        </div>
        <div class="item basis"></div>
        <div class="item base-services"></div>
        <div class="item special-services"></div>
        <div class="total"></div>
        </Toggle>
    </div> 
</template>

<script>
export default{
    name: 'ObjectCalc',
}
</script>

<style scoped>
    .object-calc{
        margin-top: 50px;
        min-height: 500px;
    }
    .title-object{
        display: flex;
        align-items: center;
        column-gap: 15px;
    }
    .title-object .name{
        font-family: 'Raleway-Light';
        font-size: 26px;
    }
    .item{
        min-height: 100px;
    }
</style>