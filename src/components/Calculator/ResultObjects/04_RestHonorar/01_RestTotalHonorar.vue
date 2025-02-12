<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="title">{{ text.Rest_total_honorar }}</div>
            <div class="price" ><Price :value ="value" /></div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export  default{
    name: 'RestTotalHonorar',
    async mounted(){
    },
    data(){
        return{
            text:{
                Rest_total_honorar: text.Calc.Rest_total_honorar,
            }
        }
    },
    props:{
        value:Number,
    },
}

</script>

<style scoped>
    .main_row{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
    }   
    .title{
        margin-left: 55px;
        width: 700px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .wrap_figures{
        width: 300px;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .wrap_imputs{
        display: flex;
        align-items: baseline;
    }
    .imputrate{
        display: flex;
        align-items: baseline;
    }
    .imputrate input{
        width: 45px!important;
        text-align: right;
        font-family: 'Comfortaa-Regular';
        font-size: 18px;
        color:#464646;
    }
    .typeSumbol{
        font-family: 'Comfortaa-Regular';
        font-size: 18px;
        color:#464646;     
    }

    .price{
        color:#838383;
    }
    .detals{
        position: relative;
    }
    .detals .icon{
        display: block;
        position: absolute;
        border-radius: 50%;
        height: 8px;
        width: 8px;
        background-color: #C0C0C0;
        content: " ";
        left: 25px;
        top: 13px;
        cursor: pointer;
    }

    .detal-list {
        background-color: #fff;
    }

    .delete{
        position: absolute;
        visibility: hidden;
    }
    .main_row:hover .delete{
        visibility:visible;
    }


</style>