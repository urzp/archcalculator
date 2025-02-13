<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="title">{{ text.Bills_payments }}</div>
            <div class="price" ><Price :value ="total*(-1)" /></div>
        </div>
        <div class="payments">
            <div class="payment" v-for="item in list" :key="item.id">
                <div class="invice_number">{{ item.invoice_number }}</div>
                <div class="title_payment_date">{{ text.previos_data }}</div>
                <div class="date_payment">{{ formatDate(item.paid_date) }}</div>
                <div class="payment_value"><Price :value ="item.paid_value"/></div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export  default{
    name: 'BillsPayments',
    async mounted(){
    },
    data(){
        return{
            text:{
                Bills_payments: text.Calc.Bills_payments,
                previos_data: text.Calc.previos_data
            }
        }
    },
    props:{
        total:[Number, String],
        list:Array,
    },
    methods:{
        formatDate(date){
           date = new Date(date)
           date = date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
           if(date=='Invalid Date') return '-'
           return date
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

    .payments{
        margin-bottom: 15px;
    }

    .payment{
        display: flex;
        align-items: center;
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 16px;
        color: #888;
    }

    .invice_number{
        width: 250px;
    }

    .title_payment_date{
        width: 250px;
    }

    .date_payment{
        width: 250px;
    }

    .payment_value{
        width: 250px;
    }

</style>