<template>
    <div class="bill_header">
        <div class="top_row">
            <div class="name_user light-text">
                <InputText_Bill :value="user_data" width="600px" noUpdate
                @submit_event="value=>update_value(value,'user_data')" />
            </div>
            <div v-if="useAvatar" class="logo_bill">
                <div><img :src="url_avatar" alt=""></div>
            </div>
        </div>
        <div v-if="!!customer" class="custemer">
            <div class="company bold-text">
                <InputText_Bill :value="customer.company" width="300px" 
                @submit_event="value=>update_value(value,'customer_company')" />
            </div>
            <div class="name bold-text">
                <InputText_Bill :value="customer.name" width="300px" 
                @submit_event="value=>update_value(value,'customer_name')" />                
            </div>
            <div class="adresse_1 bold-text">
                <InputText_Bill :value="customer.address_1" width="300px" 
                @submit_event="value=>update_value(value,'customer_address_1')" />                     
            </div>
            <div class="adresse_2 bold-text">
                <InputText_Bill :value="customer.address_2" width="300px" 
                @submit_event="value=>update_value(value,'customer_address_2')" />      
            </div>
        </div>
        <div class="main_data_bill">
            <div class="title_project_bill bold-text">
                <InputText_Bill :value="project_title" width="300px" noUpdate
                @submit_event="value=>update_value(value,'project_title')" />  
            </div>
            <div class="discription light-text">
                <ImputTextMLine_Bill :value="project_dicription" width="100%" noUpdate
                @submit_event="value=>update_value(value,'project_dicription')"/>
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
                    <InputDate :value="created" @editValue=" date=>setNewDate(date, 'created')" />
                </div>
            </div>
            <div class="payment_date light-text">
                <div class="">Leistungszeitraum vom</div>
                <InputDate :value="payment_date.vom" @editValue=" date=>setNewDate(date, 'vom') " />
                <div class="">bis</div>  
                <InputDate :value="payment_date.bis" @editValue=" date=>setNewDate(date, 'bis') " />
            </div>
            <div class="number_bill">
                <div class="title bold-text">
                    <InputText_Bill :value="number_bill" width="300px"
                    @submit_event="value=>update_value(value,'number_bill')" />
                </div>
            </div>
            <div class="greeting_phrase light-text">
                <ImputTextMLine_Bill :value="greeting_phrase" width="100%"
                @submit_event="value=>update_value(value,'greeting_phrase')"/>
            </div>
        </div>
    </div>   
</template>


<script>
import { global, user } from '@/servis/globalValues.js'
import { Bills, saveBill, setPaid } from '@/servis/projectBill.js'
import { Project, updateProject } from '@/servis/projectData.js'
export default{
    name: 'ProjBillHeader',
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
            if(!!this.actualBill&&!!this.actualBill.user_logo) url = this.actualBill.user_logo
            return url
        },
        actualBill(){
            let result = {}
            if(!!Project&&!!Project.project) result = Project.project
            return result
        },
        user_data(){
            let result = ''
            if(!!this.actualBill&&!!this.actualBill.user_data) result = this.actualBill.user_data
            return result
        },
        customer(){
            let result = this.def_customer
            if(!!this.actualBill) result = this.actualBill.customer
            return result
        },
        project_title(){
            let result = '-'
            if(!!this.actualBill) result = this.actualBill.name
            return result
        },
        project_dicription(){
            let result = '-'
            if(!!this.actualBill) result = this.actualBill.discription
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
            if(name_value=='user_data') Project.project.user_data = value
            if(name_value=='customer_company') Project.project.customer.company = value
            if(name_value=='customer_name') Project.project.customer.name = value
            if(name_value=='customer_address_1') Project.project.customer.address_1 = value
            if(name_value=='customer_address_2') Project.project.customer.address_2 = value
            if(name_value=='project_title') Project.project.name = value
            if(name_value=='project_dicription') Project.project.discription = value
            if(name_value=='invoice_number') Project.project.invoice_number = value; //setPaid(value, 'invoice_number', this.actualBill.id ) 
            if(name_value=='number_bill') Project.project.number_bill = value
            if(name_value=='greeting_phrase') Project.project.greeting_phrase = value
            updateProject()
        },
        formatDate(date){
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        setNewDate(date, selector){
            this.showSelectData=false
            this.showSelectData_2=false
            if(selector=='vom') Project.project.payment_date.vom = date
            if(selector=='bis') Project.project.payment_date.bis = date
            if(selector=='created') Project.project.created = date
            updateProject()
        }
    }
}

</script>

<style scoped>
    .bill_header{
        font-size: 20px;
        text-align: left;
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
        margin-top: 120px;
    }
    .custemer{
        margin-top: 10px;
    }

    .title_project_bill{
        font-size: 26px;
        margin-bottom: 10px;
    }

    .main_data_bill .discription{
        margin-bottom: 10px;
    }

    .payment_date{
        display: flex;
        column-gap: 5px;
        justify-content: flex-start;
    }

    .payment_date_volume, .date_created{
        cursor: pointer;
    }

    .item_title_value{
        display: flex;
        justify-content: space-between;
    }

    .number_bill{
        font-size: 26px;
        margin-top: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid #999999 ;
    }

    .datum_value{
        display: flex;
    }

    .greeting_phrase{
        margin-top: 25px;
        margin-bottom: 30px;
        margin-left: 0px;
    }


</style>