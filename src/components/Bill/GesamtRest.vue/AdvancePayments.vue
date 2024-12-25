<template>
    <div class="honorar item_base_servis light-text">
        <div class="titile_item wrap_part">
            <div class="title">2. Abzüge für geleistete Abschlagszahlungen</div>
            <div v-if="list.length==0" class="none">-</div>
        </div>
        <div class="list">
            <div class="header item_list" v-for="item in list" :key="item.id">
                <div class="colum colum_1" >
                    {{ item.invoice_number }}
                    <!-- <InputText_Bill noUpdate :value="item.invoice_number" width="200px" alight_edit="center"
                    @submit_event="value=>update_value(value, 'invoice_number', item)"/> -->
                </div>
                <div class="colum colum_2">Zahlung vom</div>
                <div class="colum colum_3">{{ formatDate(item.date) }}</div>
                <div class="colum colum_4"> <PriceBill :value="item.value" /> </div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="header item_list " v-if="list.length>0">
                <div class="colum colum_1">Summe</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"> <PriceBill :value="summe" /> </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Bills, saveBill, initPaidPrevious } from '@/servis/projectBill.js'
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
        },
        summe(){
            let result = 0 
            if(!!this.list){
                this.list.forEach(item=>{
                    result = result + Number(item.value) 
                })
            }
            return result * (-1)
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
            if(name_value=='invoice_number') elemen.invoice_number = value ; elemen.invoice_number = value
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
        font-size: 16px;
    }
    .colum_3{
        width: 11%;
        text-align: right;
        
    }
    .colum_4{
        width: 11%;
        text-align: right;
    }
    .colum_5{
        width: 12%;
        text-align: right;
    }
    .colum_6{
        width: 12%;
        text-align: right;
    }

</style>
