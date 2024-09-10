<template>
    <div class="total-level-1">
       <div class="title">Total</div>
       <div class="value-percent">100%</div>
       <div class="value-price">64.000,<span>00</span></div>
    </div>
</template>

<script>
export default{
    name: 'Total_level_1',
    props:{
        name:String,
    },
}
</script>
    
<style scoped>
.total-level-1{
    display: flex;
    justify-content: flex-end;
    column-gap: 15px;
    font-family: 'Raleway-Regular';
    font-size: 20px;
    color: var(--color-akcent);
    border-top: solid 1px var(--color-akcent);
}
</style>