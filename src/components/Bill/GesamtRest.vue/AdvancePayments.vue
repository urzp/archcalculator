<template>
    <div class="honorar item_base_servis light-text">
        <div class="titile_item wrap_part">
            <div class="title">2. Abzüge für geleistete Abschlagszahlungen</div>
            <div v-if="list.length==0" class="none">-</div>
        </div>
        <div class="list">
            <div class="header item_list" v-for="item in list" :key="item.id">
                <div class="colum colum_1" @click="openBill(item.bill_id)">
                    {{ item.invoice_number }}
                </div>
                <div class="colum colum_2">Zahlung vom</div>
                <div class="colum colum_3">{{ formatDate(item.date) }}</div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"> {{ item.value }} € </div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Bills, saveBill } from '@/servis/projectBill.js'
export default{
    name: 'AdvancePayments',
    props:{
        actualBill:Object,
    },
    computed:{
        list(){
            let result = []
            if(!!this.actualBill&&this.actualBill.paid&&!!this.actualBill.paid.previous) result = this.actualBill.paid.previous
            return result
        }
    },
    emits:['selectBill'],
    methods:{
        formatDate(date){
            if(!date) return '-'
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        openBill(bill_id){
            EventBus.emit('Bills:selectBill', bill_id )
        },
        async update_value(value, name_value, elemen){
            //if(name_value=='invoice_number') elemen.invoice_number = value
            saveBill(this.actualBill.id)
        },
        set_defaul(name_value){
            //if(name_value=='name_user') this.actualBill.name_user = `${user.name} ${!user.address?' - Adresse':user.address}`
            saveBill(this.actualBill.id)
        },
    }

}
</script>



<style scoped>

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .wrap_part{
        display: flex;
        column-gap: 15px;
    }

    .item_base_servis{
        display: flex;
        flex-direction: column;
        column-gap: 15px;
        justify-content: space-between;
    }

    .titile_item{
        display: flex;
        justify-content: space-between;
    }

    .none{
        width: 11%;
        text-align: center;
    }

    .title{
        margin-left: 15px;
    }

    .list{
        margin-left: 45px;
    }

    .item_list{
        display: flex;
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

    .item_list .colum_1{
        cursor: pointer;
    }
</style>
