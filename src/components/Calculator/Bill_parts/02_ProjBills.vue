<template>
    <div v-if="loaded" class="bill_list_wrap">
        <div class="name_project">{{ name_project }}</div>
        <div class="header">
                <div class="title">{{ text.Bills }}</div>
        </div>
        <div class="subheader" v-if="list.length > 0">
            <div class="title title_name">{{ text.Name }}</div> 
            <div class="title">{{ text.Lock }}</div> 
            <div class="title_statis">{{ text.Payment_from }}</div>         
        </div>
        <div class="list_bills">
            <div class="item" v-for="item, index in list" :key=item.id>
                <div class="wrap_left">
                    <div class="name" @click="selectBill(item.id)">{{ item.name }}</div>
                    <div class="data_price">
                        <div class="price">
                            <Price :value="item.total" font_size_unit="14px" noCents font_family="Raleway-Medium"/>
                        </div>
                        <div class="data"> {{ formatDate(item.payment_date_bis) }} </div>
                    </div>
                </div>
                <div class="wrap_right light-text">
                    <div class="invoice_number" ><InputText_Bill :lock=" item.locked " :value="item.invoice_number" width="130px"  noUpdate  alight_edit="left" :bg_input_color="'#ebaa6c'"
                        @submit_event="value=>update_value(value,'invoice_number', item)" />  </div> 
                    <div class="lock_value">
                        <CheckBox  :checked="item.locked" @switch="(value)=>update_value(Number(value), 'locked', item) "/>
                    </div>
                    <div  class="date"><InputDate :lock=" item.locked " :value="item.paid_date" @editValue=" date=>update_value(date, 'paid_date', item) " /></div>     
                    <div  class="value"><PriceInputBill :lock=" item.locked " noPanel :value ="item.paid_value" @editPrice="newValue=>update_value(newValue, 'paid_value', item)" :bg_input_color="'#ebaa6c'" />  </div>    
                </div>
                <div class="hover-panel">
                    <div class="left_part">
                        <NewButton v-if="false" @click.stop="insertNewBill(index)" width="45px" height="23px" width_img="10px"/>
                        <DeleteButton v-if=" item.locked=='0' " @click.stop="deleteBill(item.id)" width="45px" heigth="45px" width_img="15px"/>   
                    </div>
                    <div v-if="false" class="right_part">
                        <UpButton @click.stop="moveUpBill(index)" width="45px" heigth="23px" height_img="10px"/>
                        <DownButton @click.stop="moveDownBill(index)" width="45px" heigth="23px" height_img="10px"/>                    
                    </div>
                </div>
            </div>
            <div v-if="!updated" class="load update">{{ text.Loading }}</div>
            <NewButton class="newButton_bottom_list" @click.stop="newBill()" width="150px" height="30px" width_img="10px"/>
        </div>
    </div>
    <div v-else class="load">{{ text.Loading }}</div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import {text} from '@/servis/text'
import { Project, projectToBill, deleteBill, newBillSequence, setPaidBill } from '@/servis/projectData.js'
import { array_move } from '@/servis/functions.js'

export default{
    name: 'ProjBills',
    data(){
        return{
            updated: true,
            showSelectData: false,
            SelectDataName: '',
            text:{
                Bills: text.billList.Bills,
                Name: text.billList.Name,
                Payment_from: text.billList.Payment_from,
                Confirm_the_deletion: text.pupaps.Confirm_the_deletion,
                Loading: text.Calc.Loading,
                Lock: text.billList.Lock,
            },
        }
    },
    emits:['selectBill'],
    computed:{
        name_project(){
            let result = ''
            if(!!Project&&!!Project.project) result = Project.project.name
            return result
        },
        list(){
            let result = []
            if(!!Project&&!!Project.bills) result = Project.bills
            return result
        },
        loaded(){
            let result = false
            if(!!this.list) result = true
            return result
        }
    },
    methods:{
        formatDate(date){
            if(!date) return '-'
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        async moveUpBill(index){
            if(index<=0||index>this.list.length) return false
            this.updated = false
            let bills_sequence = this.list.map(item=>{return {'id':item.id, 'number':item.number}})
            await array_move(bills_sequence, index, index - 1)
            await newBillSequence(bills_sequence)
            this.updated = true
        },
        async moveDownBill(index){
            if(index<0||index+1>=this.list.length) return false
            this.updated = false
            let bills_sequence = this.list.map(item=>{return {'id':item.id, 'number':item.number}})
            await array_move(bills_sequence, index, index + 1)
            await newBillSequence(bills_sequence)
            this.updated = true
        },
        selectBill(id){
            EventBus.emit('Project:openBill', id)
        },
        async newBill(){
            this.updated = false
            await projectToBill()
            this.updated = true
        },
        async insertNewBill(index){
            this.updated = false
            index++;
            await projectToBill(undefined, index)
            this.updated = true
        },
        deleteBill(id){
            EventBus.emit('Popap:comfirm',{
                title: this.text.Confirm_the_deletion,
                action: async ()=>{
                    this.updated = false
                    await deleteBill(id)
                    this.updated = true
                },
                
            })

        },
        async update_value(value, name_value, item){
            if( name_value!='locked'&&item.locked!="0"){
                return false
            }
            this.updated = false
            this.showSelectData=false
            setPaidBill(value, name_value, item.id)
            this.updated = true
        }
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

    .bill_list_wrap{
        min-height: 300px;
        margin-top: 60px;
        margin-bottom: 20px;
    }

    .name_project{
        font-family: 'Raleway-Light';
        font-size: 36px;
        text-align: left;
        width: 100%;
    }

    .header{
        width: 80%;
        padding-bottom: 10px;
        margin-top: 30px;
        border-bottom: 1px solid #999;
        font-family: 'Raleway-Light';
        font-size: 20px;
        color: #545454;
    }

    .title_name{
        width: 60%;
    }

    .wrap_left{
        width: 50%;
        cursor: pointer;
    }

    .subheader{
        width: 80%;
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        font-family: 'Raleway-Light';
        font-size: 18px;
        color: #545454;
    }

    .title_statis{
        width: 240px;
        text-align: center;
    }

    .list_bills {
        margin-top: 20px;
        margin-bottom: 100px;
    }

    .list_bills>div:nth-child(even){
        background-color: #F5F5F5;
    }

    .item{
        width: 80%;
        display: flex;
        padding: 5px 10px;
        font-family: 'Raleway-Medium';
        justify-content: space-between;
        align-items: baseline;
        font-size: 20px;
        color: #545454;
        column-gap: 10px;
        align-items: stretch;
    }
    .item:hover{
        background-color: #ebaa6c!important;
        color: #fff;
    }

    .item:hover .data_price{
        color: #e5e5e5;
    }

    .item:hover .invoice_number{
        color: #fff;
    }

    .item:hover .date{
        color: #fff;
    }

    .item:hover .value{
        color: #fff;
    }

    .item:hover .lock_value :deep(.checkbox){
        display: none!important;
    }

    .item:hover .lock_value :deep(.checkbox_hover){
        display: flex!important;
    }

    .wrap_right{
        cursor: pointer;
        margin-right: -150px;
        padding-right: 150px;
    }

    .lock_value{
        width: 50px;
    }

    .data_price{
        width: 150px;
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        font-family: 'Raleway-Medium';
        color:#999;
        font-size: 14px;
    }

    .wrap_right{
        display: flex;
        column-gap: 5px;
        font-size: 18px;
        align-items: center;
    }

    .wrap_right .date{
        width: 110px;
        display: flex;
        justify-content: flex-end;
    }

    .invoice_number{
        width: 120px;
        font-family: 'Raleway-Medium';
    }

    .hover-panel{
        position: relative;
        width: 0px;
        transform: translateX(30px);
        display: flex;
        column-gap: 5px;
        visibility: hidden;
    }

    .left_part, .right_part{
        display: flex;
        row-gap: 5px;
        flex-direction: column;   
        justify-content: center;  
    }

    .item:hover .hover-panel{
        visibility: visible;
    }

    .wrap_right:hover .hover-panel{
        visibility: visible;
    }

    .hover-panel:hover{
        visibility: visible;
    }

    .status, .data_paid{
        width: 140px;
        text-align: center;
        font-size: 18px;
    }

    .value{
        width: 140px;
        text-align: right;
        font-size: 18px;
    }

    .data_pai{
        width: 80px;
    }

    .newButton_bottom_list{
        margin-top: 10px;
    }

    .load{
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
    }

    .update{
        align-items: center;
        justify-content: flex-start;
        min-height: 70px;
        padding-left: 10px;
        background-color: #fff!important;
    }

    .checkbox{
        display: flex;
        justify-content: center;
    }

    .checkbox img{
        width: 25px;
    }
 
</style>