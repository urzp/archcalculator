<template>
    <div class="bill_list_wrap">
        <div class="name_project">{{ name_project }}</div>
        <div class="header">
                <div class="title">{{ text.Bills }}</div>
        </div>
        <div class="subheader" v-if="list.length > 0">
            <div class="title">{{ text.Name }}</div> 
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
                        <div class="data"> {{ formatDate(item.payment_date) }} </div>
                    </div>
                </div>
                <div class="wrap_right light-text">
                    <div class="invoice_number">{{ item.invoice_number }}</div> 
                    <div  class="date"><InputDate :value="item.paid_date" @editValue=" date=>update_value(date, 'paid_date', item.id) " /></div>     
                    <div  class="value">
                        <PriceInputBill noPanel :value ="item.paid_value" @editPrice="newValue=>update_value(newValue, 'paid_value', item.id)" />  
                    </div>
                    
                    <!-- <div class="status">{{ item.fact_paid?'bezahlt':'nicht bezahlt' }}</div> -->
                </div>
                <div class="hover-panel">
                    <div class="left_part">
                        <UpButton @click.stop="moveUpBill(index)" width="45px" heigth="23px" height_img="10px"/>
                        <DownButton @click.stop="moveDownBill(index)" width="45px" heigth="23px" height_img="10px"/>
                    </div>
                    <div class="right_part">
                        <NewButton @click.stop="newBill(index)" width="45px" height="23px" width_img="10px"/>
                        <DeleteButton @click.stop="deleteBill(item.id)" width="45px" heigth="23px" width_img="10px"/>                       
                    </div>
                </div>
            </div>
            <NewButton class="newButton_bottom_list" @click.stop="newBill()" width="150px" height="30px" width_img="10px"/>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import {text} from '@/servis/text'
import { Project, projectToBill, deleteBill } from '@/servis/projectData.js'
import { array_move } from '@/servis/functions.js'

export default{
    name: 'ProjBills',
    data(){
        return{
            showSelectData: false,
            SelectDataName: '',
            text:{
                Bills: text.billList.Bills,
                Name: text.billList.Name,
                Payment_from: text.billList.Payment_from,
                Confirm_the_deletion: text.pupaps.Confirm_the_deletion,
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
    },
    methods:{
        formatDate(date){
            if(!date) return '-'
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        // async newBill(index){
        //     let newBilleLelement = await newBill(Project.project.id, index)
        //     Bills.splice(index, 0, newBilleLelement)
        //     this.selectBill(index)
        // },
        async moveUpBill(index){
            if(index<=0||index>this.list.length) return false
            await array_move(Bills,index,index - 1)
            sequence()
        },
        async moveDownBill(index){
            if(index<0||index>=this.list.length) return false
            await array_move(Bills,index,index + 1)
            sequence()
        },
        selectBill(id){
            EventBus.emit('Project:openBill', id)
        },
        async newBill(){
           await projectToBill()
        },
        deleteBill(id){
            EventBus.emit('Popap:comfirm',{
                title: this.text.Confirm_the_deletion,
                action: async ()=>{
                    //this.list.splice(index, 1);
                    await deleteBill(id)

                    //sequence()
                },
                
            })

        },
        async update_value(value, name_value, id){
            this.showSelectData=false
            if(name_value=='paid_value') setPaid(value, 'value', id)
            if(name_value=='paid_date') setPaid(value, 'date',id)
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

    .wrap_left{
        width: 50%;
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

    .item{
        width: 80%;
        display: flex;
        font-family: 'Raleway-Medium';
        justify-content: space-between;
        align-items: baseline;
        font-size: 20px;
        color: #545454;
        column-gap: 10px;
        align-items: stretch;
    }

    .wrap_right{
        cursor: pointer;
        margin-right: -150px;
        padding-right: 150px;
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
    }

    .wrap_right .date{
        width: 140px;
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
        /* transform: translateX(-110px); */
        display: flex;
        column-gap: 5px;
        visibility: hidden;
    }

    .left_part, .right_part{
        display: flex;
        row-gap: 5px;
        flex-direction: column;     
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
 
</style>