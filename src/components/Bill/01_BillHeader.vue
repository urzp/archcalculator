<template>
    <div class="bill_header">
        <div class="top_row">
            <div class="name_user light-text">
                <InputText_Bill :value="name_user" width="300px" 
                @submit_event="value=>update_value(value,'name_user')" 
                @setDefault="set_defaul('name_user')"/>
            </div>
            <div v-if="useAvatar" class="logo_bill">
                <div><img :src="url_avatar" alt=""></div>
            </div>
        </div>
        <div v-if="!!customer" class="custemer">
            <div class="company bold-text">
                <InputText_Bill :value="customer.company" width="300px" 
                @submit_event="value=>update_value(value,'customer_company')" 
                @setDefault="set_defaul('customer_company')"/>
            </div>
            <div class="name bold-text">
                <InputText_Bill :value="customer.name" width="300px" 
                @submit_event="value=>update_value(value,'customer_name')" 
                @setDefault="set_defaul('customer_name')"/>                
            </div>
            <div class="adresse_1 bold-text">
                <InputText_Bill :value="customer.address_1" width="300px" 
                @submit_event="value=>update_value(value,'customer_address_1')" 
                @setDefault="set_defaul('customer_address_1')"/>                     
            </div>
            <div class="adresse_2 bold-text">
                <InputText_Bill :value="customer.address_2" width="300px" 
                @submit_event="value=>update_value(value,'customer_address_2')" 
                @setDefault="set_defaul('customer_address_2')"/>      
            </div>
        </div>
        <div class="main_data_bill">
            <div class="title_project_bill bold-text">
                <InputText_Bill :value="project_title" width="300px" 
                @submit_event="value=>update_value(value,'project_title')" 
                @setDefault="set_defaul('project_title')"/>  
            </div>
            <div class="discription light-text">
                <ImputTextMLine_Bill :value="project_dicription" width="100%"
                @submit_event="value=>update_value(value,'project_dicription')"
                @setDefault="set_defaul('project_dicription')"/>
            </div> 
            <div class="payment_date light-text">
                <div class="">Leistungszeitraum vom</div>
                <div class="payment_date_volume"  @click.stop="showSelectData=true; SelectDataName='vom'">
                    {{ formatDate(payment_date.vom) }}
                </div>  
                <div class="">bis</div>  
                <div class="payment_date_volume"  @click.stop="showSelectData=true; SelectDataName='bis'">
                    {{ formatDate(payment_date.bis) }}
                </div>
                <div v-if="showSelectData" class="selectData" @click.stop="" style="margin-left: -5px;">
                    <div class="wrap_calendar">
                        <Calendar popap :openMonth="new Date( selectDay )" :selectDay="new Date( selectDay )" :projects="[]" @selectDay="day=>setNewDate(day)" @closeCalendar="showSelectData=false"/>
                    </div>
                </div>
            </div>
            <div class="item_title_value">
                <div class="invoice_number title bold-text">Rechnung Nr.</div>
                <div class="invoice_number value bold-text">
                    <InputText_Bill :value="invoice_number" width="150px"  noUpdate  alight_edit="center"
                    @submit_event="value=>update_value(value,'invoice_number')" />  
                </div>
            </div>
            <div class="item_title_value">
                <div class="datum title bold-text">Datum</div>
                <div class="datum_value bold-text">
                    <div class="date_created" @click.stop="showSelectData_2=true; SelectDataName='created'">
                        {{ formatDate(created) }}
                    </div>
                    <div v-if="showSelectData_2" class="selectData" @click.stop="">
                    <div class="wrap_calendar">
                        <Calendar popap :openMonth="new Date( created )" :selectDay="new Date( created )" :projects="[]" @selectDay="day=>setNewDate(day)" @closeCalendar="showSelectData_2=false"/>
                    </div>
                </div>
                </div>
            </div>
            <div class="number_bill">
                <div class="title bold-text">
                    <InputText_Bill :value="number_bill" width="300px"
                    @submit_event="value=>update_value(value,'number_bill')" 
                    @setDefault="set_defaul('number_bill')"/>
                </div>
            </div>
            <div class="greeting_phrase light-text">
                <ImputTextMLine_Bill :value="greeting_phrase" width="100%"
                @submit_event="value=>update_value(value,'greeting_phrase')"
                @setDefault="set_defaul('greeting_phrase')"/>
            </div>
        </div>
    </div>   
</template>


<script>
import { global, user } from '@/servis/globalValues.js'
import { Bills, saveBill } from '@/servis/projectBill.js'
import { Project } from '@/servis/projectData.js'
export default{
    name: 'BillHeader',
    data(){
        return {
            def_name_user: 'Name und Adresse des Architekten',
            def_customer:{
                company: 'Customer Company',
                name: 'Customer Name',
                address_1: 'Street',
                address_2: 'Post und Stadt',
            },
            showSelectData:false,
            showSelectData_2:false,
            SelectDataName:'vom',
        }
    },
    props:{
        bill_item:[Number, String]
    },
    computed:{
        useAvatar(){
            let result = false
            if(!!global.login) {
                result = !!user.avatar
            }
            return result
        },
        url_avatar(){
            let url = `${global.base_url}/users/user_${user.id}/avatar/${user.avatar}`
            return url
        },
        actualBill(){
            let result = {}
            if(!!Bills&&Bills.length>0) result = Bills[this.bill_item]
            return result
        },
        name_user(){
            let result = this.def_name_user
            if(!!this.actualBill) result = this.actualBill.name_user
            return result
        },
        customer(){
            let result = this.def_customer
            if(!!this.actualBill) result = this.actualBill.custemer
            return result
        },
        project_title(){
            let result = '-'
            if(!!this.actualBill&&!!this.actualBill.project) result = this.actualBill.project.name
            return result
        },
        project_dicription(){
            let result = '-'
            if(!!this.actualBill&&!!this.actualBill.project) result = this.actualBill.project.discription
            return result
        },
        payment_date(){
            let result = {
                vom: new Date(),
                bis: new Date(),
            }
            if(!!this.actualBill&&!!this.actualBill.payment_date) result = this.actualBill.payment_date
            return result
        },
        selectDay(){
            if(this.SelectDataName=='vom') return this.payment_date.vom
            if(this.SelectDataName=='bis') return this.payment_date.bis
        },
        invoice_number(){
            let result = '-'
            if(!!this.actualBill&&!!this.actualBill.invoice_number) result = this.actualBill.invoice_number
            return result
        },
        created(){
            let result = new Date()
            if(!!this.actualBill&&!!this.actualBill.created) result = this.actualBill.created
            return result
        },
        number_bill(){
            let result = '-'
            if(!!this.actualBill&&!!this.actualBill.number_bill) result = this.actualBill.number_bill
            return result
        },
        greeting_phrase(){
            let result = '-'
            if(!!this.actualBill&&!!this.actualBill.greeting_phrase) result = this.actualBill.greeting_phrase
            return result            
        }
    },
    methods:{
        async update_value(value, name_value){
            if(name_value=='name_user') this.actualBill.name_user = value
            if(name_value=='customer_company') this.actualBill.custemer.company = value
            if(name_value=='customer_name') this.actualBill.custemer.name = value
            if(name_value=='customer_address_1') this.actualBill.custemer.address_1 = value
            if(name_value=='customer_address_2') this.actualBill.custemer.address_2 = value
            if(name_value=='project_title') this.actualBill.project.name = value
            if(name_value=='project_dicription') this.actualBill.project.discription = value
            if(name_value=='invoice_number') this.actualBill.invoice_number = value; this.actualBill.paid.invoice_number = value
            if(name_value=='number_bill') this.actualBill.number_bill = value
            if(name_value=='greeting_phrase') this.actualBill.greeting_phrase = value
            saveBill(this.actualBill.id)
        },
        set_defaul(name_value){
            if(name_value=='name_user') this.actualBill.name_user = `${user.name} ${!user.address?' - Adresse':user.address}`
            if(name_value=='customer_company') this.actualBill.custemer.company = Project.project.customer.company
            if(name_value=='customer_name') this.actualBill.custemer.company = Project.project.customer.name
            if(name_value=='customer_address_1') this.actualBill.custemer.address_1 = Project.project.customer.address_1
            if(name_value=='customer_address_2') this.actualBill.custemer.address_2 = Project.project.customer.address_2
            if(name_value=='project_title') this.actualBill.project.name = Project.project.name
            if(name_value=='project_dicription') this.actualBill.project.discription = Project.project.discription
            if(name_value=='number_bill') this.actualBill.number_bill = `${Bills.length}. Abschlagsrechnung`
            if(name_value=='greeting_phrase') this.actualBill.greeting_phrase = window.text.bill.greeting_phrase
            saveBill(this.actualBill.id)
        },
        formatDate(date){
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        setNewDate(date){
            this.showSelectData=false
            this.showSelectData_2=false
            if(this.SelectDataName=='vom') this.actualBill.payment_date.vom = date
            if(this.SelectDataName=='bis') this.actualBill.payment_date.bis = date
            if(this.SelectDataName=='created') this.actualBill.created = date
            saveBill(this.actualBill.id)
        }
    }
}

</script>

<style scoped>
    .bill_header{
        font-size: 18px;
    }

    .top_row{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .logo_bill img{
        width: 63px;
        height: 63px;
    }

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .main_data_bill{
        margin-top: 50px;
    }

    .main_data_bill .discription{
        width: 60%;
    }

    .payment_date{
        margin-top: -10px;
        text-align: right;
        display: flex;
        column-gap: 5px;
        justify-content: flex-end;
    }

    .payment_date_volume, .date_created{
        cursor: pointer;
    }

    .item_title_value{
        display: flex;
        justify-content: space-between;
    }

    .number_bill{
        margin-top: 30px;
        border-bottom: 1px solid #999999 ;
    }

    .datum_value{
        display: flex;
    }

    .greeting_phrase{
        margin-top: 30px;
        margin-bottom: 30px;
        margin-left: 100px;
    }

    .selectData{
        position: relative;
        width: 0;
        height: 0;
    }
    .wrap_calendar{
        position: absolute;
        display: flex;
        justify-content: center;
        right: 5px;
        top: 30px;
        width: 350px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 15px #898989d6;
        background-color: #fff;
    }
</style>