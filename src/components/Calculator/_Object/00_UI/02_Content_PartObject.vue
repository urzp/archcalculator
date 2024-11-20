<template>
    <div class="PartObjectList" :class="{collapse}">
        <slot/>
    </div>
</template>

<script>
export default{
    name: 'Content_PartObject',
    props:{
        collapse:Boolean,
    },
    emits: ['open_close'],
}
</script>

<style scoped>
    .collapse{
        height: 0;
        display: none;
    }

    :slotted( div:nth-child(2n-1) ) {
        background-color: #F5F5F5;
    }
</style>