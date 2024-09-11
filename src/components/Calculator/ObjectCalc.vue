<template>
    <div class="object-calc">
        
        <div class="title-object">
            <ToggleButton @switch_tg="(val)=>{collapse = !val}"/>
            <div class="name">Object A</div>
            <CloseButton class="align-left"/>
        </div>
        <Toggle :collapse="false">
        <SubObject name="Basis"/>
        <SubObject name="Base services"/>
        </Toggle>
        <div class="total">
            <div class="wrap">
                <div class="title-total">Objec A</div>
                <div class="data-total">
                    <div class="label">Total</div>
                    <div class="procent">100%</div>
                    <Price value = '1240200.54' font_size_unit="24px" font_size_cent="18px"/>
                </div>
            </div>
        </div>
    </div> 
    
</template>

<script>
export default{
    name: 'ObjectCalc',
    data(){
        return{
            collapse: false,
        }
    }
}
</script>

<style scoped>
    .object-calc{
        margin-top: 50px;
        margin-bottom: 90px;
        min-height: 500px;
    }
    .title-object{
        display: flex;
        align-items: center;
        column-gap: 15px;
        margin-left: 30px;
    }
    .title-object .name{
        font-family: 'Raleway-Light';
        font-size: 26px;
    }
    .item{
        min-height: 100px;
    }
    .align-left{
        margin-left: auto;
    }
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
        align-items: flex-end;
        column-gap: 15px;
        border-top: solid 1px var(--color-akcent);
    }

</style>