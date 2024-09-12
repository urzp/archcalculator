<template>
    <div class="total" :class="{collapse}">
        <div class="wrap">
            <div class="title-total" :class="{collapse}">Objec A</div>
            <div class="data-total">
                <div class="label">Total</div>
                <div class="procent">100%</div>
                <Price value = '1240200.54' font_size_unit="24px" font_size_cent="18px"/>
            </div>
        </div>
    </div>  
</template>

<script>
export default{
    name: 'ObjectTotal',
    props:{
        collapse:Boolean,
    }
}
</script>

<style scoped>
    .total{
        height: 110px;
        display: flex;
        justify-content: flex-end;
        background-color: #F5F5F5;
        border-left: solid 1px #C0C0C0;
        font-size: 24px;
        color: var(--color-akcent);
    }
    .total .wrap{
        margin-right: 40px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
    }
    .data-total{
        display: flex;
        align-items: baseline;
        column-gap: 15px;
        border-top: solid 1px var(--color-akcent);
    }

    /* ------------------ collapse ------------------- */

    .total.collapse{
        position: relative;
        top: -112px;
        left: -36px;
        background-color: transparent;;
        border: none;
        color: #8b8b8b;
        pointer-events: none;
    }

    .title-total.collapse{
        display: none;
    }

    .collapse .data-total{
        border: none;
    }
</style>