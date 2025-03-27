<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="title">{{ text.Total_tax }}</div>
            <div class="wrap_figures">
                <div class="wrap_colum wrap_colum_1">
                </div>
                <div class="wrap_colum wrap_colum_2">
                    <Percent input_type :value = "percent" @edit_value="value=>updateItem(value)"/>
                </div>
                <div class="wrap_colum wrap_colum_3">
                    <div class="price" ><Price :value ="value" /></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export  default{
    name: 'TotalTax',
    async mounted(){
    },
    data(){
        return{
            text:{
                Total_tax: text.Calc.Total_tax,
            } 
        }
    },
    props:{
        finance:[String,Number],
        percent:[String,Number],
    },
    computed:{
        value(){
            return Number(this.finance) * Number(this.percent)/100
        },
    },
    emits:['updateItem'],
    methods:{
        updateItem(value){
            this.$emit('updateItem', value)
        },   
    }
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
        width: 60%;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .wrap_figures{
        width: 40%;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .wrap_colum{
        display: flex;
        align-items: baseline;
        justify-content: flex-end;
    }
    .wrap_colum_1{
        width: 25%;
    }
    .wrap_colum_2{
        width: 35%;
    }
    .wrap_colum_3{
        width: 40%;
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