<template>
    <div class="total-part-obj">
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
    name: 'PartObjectTotal',
    props:{
        name:String,
        collapse: Boolean,
    },
}
</script>
    
<style scoped>
.total-part-obj{
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
    margin-right: 40px;
}

.total-part-obj .wrap{
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