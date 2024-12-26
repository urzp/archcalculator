<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">V.<span>Gesamt- und Resthonoraranspruch</span></div>
            <div class="hover-panel">
                <UpdateBtn class="button" width="35px" height="28px" @click="set_default_list()"/>
            </div>
        </div>
        <div class="list">
            <div class="content item_list light-text">
                <div class="colum colum_1">1. Rechnerisches Gesamthonorar</div>
                <div class="colum colum_2">
                    <PriceBill :value="calc_total" />
                </div>
            </div>
            <AdvancePayments :actualBill="actualBill"/>  
            <div class="content item_list bold-text">
                <div class="colum colum_1">3. Restlicher Honoraranspruch</div>
                <div class="colum colum_2">
                    <PriceBill :value="calc_rest_paide" />
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill, initPaidPrevious  } from '@/servis/projectBill.js'
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
            let result = 0
            if(!!this.actualBill&&!!this.actualBill.total) result = this.actualBill.total
            return result           
        },
        calc_rest_paide(){
            let result = 0
            if(!!this.actualBill&&!!this.actualBill.paid){
                result = this.actualBill.total
                this.actualBill.paid.previous.forEach(item=>{
                    result = result - item.value
                    if(result<0) result = 0
                })
                this.actualBill.total_rest = result
                saveBill(this.actualBill.id)
            }
            return result
        }
    },
    methods:{
        set_default_list(){
            initPaidPrevious(this.actualBill.id)
            saveBill(this.actualBill.id)
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

    .hover-panel{
        visibility: hidden;
    }

    .item:hover .hover-panel{
        visibility: visible;
    }

    .header_item:hover .hover-panel{
        visibility: visible;
    }


</style>