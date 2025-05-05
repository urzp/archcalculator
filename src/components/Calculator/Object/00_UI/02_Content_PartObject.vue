<template>
    <div ref="slot" class="PartObjectList" :class="{collapse, mark_rows}">
        <slot/>
    </div>
</template>

<script>
export default{
    name: 'Content_PartObject',
    updated () {
        
        let rows = this.$refs.slot.children.length;
        if(rows>3){ this.mark_rows = true } else { this.mark_rows = false } 
   
    },
    data(){
        return {
            mark_rows: false,
        }
    },
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

    .mark_rows:slotted( div:nth-child(2n-1) ) {
        background-color: #F5F5F5;
    }
</style>