<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">V.<span>Gesamt- und Resthonoraranspruch</span></div>
        </div>
        <div class="list">
            <div class="content item_list light-text">
                <div class="colum colum_1">1. Rechnerisches Gesamthonorar</div>
                <div class="colum colum_2">
                    <Price :value="calc_total" font_size_unit="18px" font_family="Raleway-Medium"/>
                </div>
            </div>
            <AdvancePayments :actualBill="actualBill"/>  
            <div class="content item_list bold-text">
                <div class="colum colum_1">3. Restlicher Honoraranspruch</div>
                <div class="colum colum_2"></div>
            </div>
        </div>
    </div>  
</template>

<script>
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill } from '@/servis/projectBill.js'
export default{
    name: 'GesamtRest',
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
        calc_total(){
            let result = {}
            if(!!this.actualBill&&!!this.actualBill.total) result = this.actualBill.total
            return result           
        },
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
        border-top: 1px solid #999;
        border-bottom: 1px solid #999;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .title span{
        margin-left: 10px;
    }

    .list{
        margin-left: 30px;
        margin-bottom: 15px;
    }

    .item_list{
        display: flex;
    }

    .colum_1{
        width: 89%;
    }
    .colum_2{
        width: 11%;
        display: flex;
        justify-content: flex-end;
    }
</style>