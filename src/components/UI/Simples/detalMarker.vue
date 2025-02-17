<template>
    <div  class="detals">
        <div class="icon" :class="{open:!collapse, close:collapse}"></div>
    </div>
</template>

<script>
    export default {
        name: 'DetalMarker',
        props:{
            collapse:Boolean,
        }
    }

</script>


<style scoped>
    .detals{
        position: relative;
    }

    .icon.close{
        display: block;
        position: absolute;
        height: 8px;
        width: 8px;
        border-radius: 4px;
        border: 6px solid transparent;
        border-top: 8px solid #C0C0C0;
        content: " ";
        left: 23px;
        top: 13px;
        cursor: pointer;
    }

    .icon.open{
        display: block;
        position: absolute;
        border-radius: 50%;
        height: 8px;
        width: 8px;
        background-color: #C0C0C0;
        content: " ";
        left: 25px;
        top: 13px;
        cursor: pointer;
    }

</style>


