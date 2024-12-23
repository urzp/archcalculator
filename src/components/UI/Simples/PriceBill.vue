<template>
    <div class="price">{{ price_unit }}, <span>{{ price_cent }} {{ typeCurrancy }}</span></div>
</template>

<script>
import { intToFloat } from '@/servis/functions'
export default{
    name: 'PriceBill',
    mounted(){

    },
    data(){
        return{

        }
    },
    props:{
        value:[String, Number],
        typeCurrancy:{
            type: String,
            default: '€',
        },
    },    
    computed:{
        price_unit(){
            let result = 0
            if(!!this.value){ 
                let value =  Number(this.value) 
                let unit = Math.trunc(value)
                result = unit.toLocaleString("de-DE")
            }
            return result
        },
        price_cent(){
            let result = 0
            if(!!this.value) result = Number(this.value)
            result = intToFloat( result, 2).split('.')[1]
            return result
        }
    },
}
</script>

<style scoped>

    .price{
        color: inherit;
        font-size: inherit;
        font-family: inherit;
        text-align: inherit;
    }

    .price span{
        font-size: medium;
    }

    .edit_wrap{
        position: relative;
        z-index: 100;
    }

    .edit_block{
        display: flex;
    }

    .wrap_imput{
        display: flex;
        align-items: baseline;
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 10px;
        padding-right: 10px;
    }

    input{
        width: 100%;
        color: inherit;
        font-size: inherit;
        font-family: inherit;
        text-align: inherit;
    }

    .panel{
        position: relative;
        left: 5px;
        width: 0px;
        z-index: 100;
    }

    .edit_wrap{
        position: relative;
        z-index: 100;
    }

    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
</style>