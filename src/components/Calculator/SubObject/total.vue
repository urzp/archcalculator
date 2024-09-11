<template>
    <div class="total-level-1">
        <div class="wrap" :class="{line:!collapse}">
            <div class="title">Total</div>
            <div class="value-percent">100%</div>
            <Price value = '1700200.54'/>
        </div>
    </div>
</template>

<script>
import Price from '@/components/UI/Price.vue';

export default{
    name: 'SubObjectTotal',
    props:{
        name:String,
        collapse: Boolean,
    },
}
</script>
    
<style scoped>
.total-level-1{
    display: flex;
    justify-content: flex-end;
    margin-right: 40px;
}

.total-level-1 .wrap{
    display: flex;
    justify-content: flex-end;
    column-gap: 15px;
    font-family: 'Raleway-Regular';
    font-size: 20px;
    color: var(--color-akcent);
}
.wrap.line{
    border-top: solid 1px var(--color-akcent);
}
</style>