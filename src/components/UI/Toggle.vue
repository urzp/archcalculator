<template>
    <div class="toggle" :class="{collapse}">
        <div class="wrap-slot" :class="{collapse}">
            <slot/>
        </div>
    </div>
</template>

<script>
export default{
    name: 'Toggle',
    props:{
        collapse: Boolean,
    },
}
</script>

<style scoped>
    .toggle{
        border-left: solid 1px  #E4E4E4;
        padding-bottom: 25px;
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
        top: -28px;
    }

    .wrap-slot{
        margin-top: -25px;
        margin-left: 30px;
    }

    .toggle.collapse{
        border:none;
    }

    .wrap-slot.collapse{
        height: 0;
        display: none;
    }

</style>