<template>
    <div class="total-part-obj" :class="{collapse:collapse}">
        <div class="wrap" :class="{line:!collapse}">
            <div class="title">Total</div>
            <div class="value-percent">{{ data.percent }} %</div>
            <Price :value = 'data.value'/>
        </div>
    </div>
</template>

<script>

export default{
    name: 'PartObjectTotal',
    props:{
        name:String,
        collapse: Boolean,
        data: {
            type:Object,
            default: {value: 0, percent: 0},
        },
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

.total-part-obj.collapse{
    margin-top: 0px;
}
</style>