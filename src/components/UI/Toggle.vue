<template>
    <div class="toggle">
        <div class="wrap-slot">
            <slot/>
        </div>
    </div>
</template>

<script>
export default{
    name: 'Toggle',
}
</script>

<style scoped>
    .toggle{
        border-left: solid 1px  #E4E4E4;
    }

    .toggle:before{
        display: block;
        position: relative;
        border-radius: 50%;
        height: 11px;
        width: 11px;
        background-color: #C0C0C0;
        content: " ";
        left: -6px;
    }

    .wrap-slot{
        margin-top: -25px;
        margin-left: 30px;
    }

</style>