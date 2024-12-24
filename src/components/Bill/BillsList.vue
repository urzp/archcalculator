<template>
    <div class="bill_list_wrap">
        <div class="name_project">{{ name_project }}</div>
        <div class="header">
                <div class="title">Bills</div>
        </div>
        <div class="subheader">
            <div class="title">Name</div> 
            <div class="title_statis">Zahlung vom</div>         
        </div>
        <div class="list_bills">
            <div class="item" v-for="item, index in list" :key=item.id>
                <div class="hover-panel">
                    <DeleteButton @click.stop="deleteBill(item.id)" width="35px" heigth="28px"/>
                </div>
                <div class="wrap_left">
                    <div class="name" @click="selectBill(index)">{{ item.name }}</div>
                    <div class="data_price">
                        <div class="price">
                            <Price :value="item.total" font_size_unit="14px" noCents font_family="Raleway-Medium"/>
                        </div>
                        <div class="data"> {{ formatDate(item.payment_date.bis) }} </div>
                    </div>
                </div>
                <div class="wrap_right light-text">
                    <div class="invoice_number">{{ item.invoice_number }}</div> 
                    <div class="date"><InputDate :value="item.paid.date" @editValue=" date=>update_value(date, 'paid_date', item.id) " /></div>     
                    <div class="value">
                        <PriceInputBill noPanel :value ="item.paid.value" @editPrice="newValue=>update_value(newValue, 'paid_value', item.id)" />  
                    </div>
                    
                    <!-- <div class="status">{{ item.fact_paid?'bezahlt':'nicht bezahlt' }}</div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill, deleteBill, setPaid } from '@/servis/projectBill.js'

export default{
    name: 'BillsList',
    data(){
        return{
            showSelectData: false,
            SelectDataName: '',
        }
    },
    props:{
        list:Array,
    },
    emits:['selectBill'],
    computed:{
        name_project(){
            let result = ''
            if(!!Project&&!!Project.project) result = Project.project.name
            return result
        }
    },
    methods:{
        formatDate(date){
            if(!date) return '-'
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        selectBill(index){
            this.$emit('selectBill', index)
        },
        deleteBill(id){
            let index = this.list.findIndex(item=>item.id==id);
            EventBus.emit('Popap:comfirm',{
                title:'Bestätigen Sie den Löschvorgang',
                action: async ()=>{
                    this.list.splice(index, 1);
                    deleteBill(id)
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
        width: 60%;
        padding-bottom: 10px;
        margin-top: 30px;
        border-bottom: 1px solid #999;
        font-family: 'Raleway-Light';
        font-size: 20px;
        color: #545454;
    }

    .subheader{
        width: 60%;
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
        width: 60%;
        display: flex;
        font-family: 'Raleway-Medium';
        justify-content: space-between;
        align-items: baseline;
        font-size: 20px;
        color: #545454;
        column-gap: 10px;
    }

    .name{
        cursor: pointer;
        margin-left: -50px;
        padding-left: 50px;
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
        position: absolute;
        transform: translateX(-60px);
        display: flex;
        column-gap: 5px;
        visibility: hidden;
    }

    .item:hover .hover-panel{
        visibility: visible;
    }

    .name:hover .hover-panel{
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


 
</style>