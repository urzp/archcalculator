<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">II.<span>Zusätzliche Leistungen</span></div>
        </div>
        <div class="list">
            <div class="content item_list light-text" v-for="item in list" :key="item.id">
                <div class="colum colum_1">{{ !item.title?'Leistung eingeben':item.title }}</div>
                <div class="colum colum_2">{{ item.hours }}h</div>
                <div class="colum colum_3">{{ item.price_hours }}€</div>
                <div class="colum colum_4">{{ item.total }}</div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>  
</template>

<script>
import { Bills, saveBill } from '@/servis/projectBill.js'
export default{
    name: 'AdditionalLeistungen',
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
        list(){
            let result = []
            if(!!this.actualBill&&!!this.actualBill.extraServis) result=this.actualBill.extraServis
            return result
        }
    }

}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
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
    }

    .item_list{
        display: flex;
        margin-bottom: 15px;
    }

    .colum_1{
        width: 43%;
    }
    .colum_2{
        width: 11%;
        text-align: center;
    }
    .colum_3{
        width: 11%;
        text-align: center;
    }
    .colum_4{
        width: 11%;
        text-align: center;
    }
    .colum_5{
        width: 12%;
    }
    .colum_6{
        width: 12%;
    }
</style>