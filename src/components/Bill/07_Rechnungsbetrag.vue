<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">Rechnungsbetrag</div>
            <div class="value">
                <PriceBill :value="total_rest" />
            </div>
        </div>
    </div>  
</template>

<script>
import { Bills } from '@/servis/projectBill.js'
export default{
    name: 'Rechnungsbetrag',
    data(){
        return{

        }
    },
    props:{
        bill_item:[Number, String]
    },
    computed:{
        actualBill(){
            let result = {}
            if(!!Bills&&Bills.length>0) result = Bills[this.bill_item]
            return result
        },
        total_rest(){
            let result = {}
            if(!!this.actualBill&&!!this.actualBill.total_rest) result = this.actualBill.total_rest
            return result
        }
    }
}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
    }

    .content{
        margin-left: 15px;
    }

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .header_item{
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #999;
        border-bottom: 1px solid #999;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .title span{
        margin-left: 10px;
    }
</style>