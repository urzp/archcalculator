<template>
    <div class="title-project">
        <!-- <div class="name" >{{ project_name }}</div> -->
        <input type="text"  class="name" :value="project_name" @change="event=>newProjectName(event.target.value)"/>
        <div class="date">{{ created }}</div>
        <div class="discription">
            <!-- <div class="title_discription">Description:</div> -->
            <div class="content_discription">
                <ImputTextMLine width="1000px" :value="discription" @submit_event="value=>newProjectDiscription(value)"/>
            </div>
        </div>
        <div v-if="login&&!no_full_inf&&status_project!='calc'" class="customer">
            <div class="title">{{ text.Customer }}</div>
            <div class="customer_company">
                <InputText :value="customer_company" width="200px" @submit_event="value=>newProjectCustemer('company', value)"></InputText>
            </div>
            <div class="customer_name">
                <InputText :value="customer_name" width="200px" @submit_event="value=>newProjectCustemer('name', value)"></InputText>
            </div>
            <div class="customer_name">
                <InputText :value="customer_address_1" width="200px" @submit_event="value=>newProjectCustemer('address_1', value)"></InputText>
            </div>
            <div class="customer_name">
                <InputText :value="customer_address_2" width="200px" @submit_event="value=>newProjectCustemer('address_2', value)"></InputText>
            </div>
        </div>
        <!-- v-if="login&&status_project!='bill'" -->
        <div  class="bill_header_data"> 
            <div class="payment_date light-text">
                <div class="">Leistungszeitraum vom</div>
                <InputDate :value="new Date()" @editValue=" date=>console.log(date) " />
                <div class="">bis</div>  
                <InputDate :value="new Date()" @editValue=" date=>console.log(date) " />
            </div>
            <div class="item_title_value">
                <div class="invoice_number bold-text">Rechnung Nr.</div>
                <div class="invoice_number value bold-text">
                    <InputText_Bill :value="invoice_number" width="150px"  noUpdate  alight_edit="center"
                    @submit_event="value=>update_value(value,'invoice_number')" />  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Project } from '@/servis/projectData';
import {  formatDate } from '@/servis/functions.js'
import {  updateProject } from '@/servis/projectData.js'
import { global } from '@/servis/globalValues.js'
import { text } from '@/servis/text.js'
export default{
    name: 'CalcTitle',
    data(){
        return{
            text:{
                Customer: text.Calc.Customer,
            },
            login: global.login,
        }
    },
    props:{
        no_full_inf:{
            type:Boolean,
            default:false,
        }
    },
    computed:{
        project_name(){
            let result = ''
            if(!!this.project&&!!this.project.name){ result = this.project.name }
            return result
        },
        created(){
            let result = ''
            if(!!this.project&&!!this.project.created){ result = formatDate(this.project.created)}
            return result
        },
        discription(){
            let result = ''
            if(!!this.project&&!!this.project.discription){ result = this.project.discription}
            return result           
        },
        status_project(){
            let result = 'clac'
            if(!!this.project&&!!this.project.status) result = this.project.status
            return result
        },
        customer_company(){
            let result = 'Company'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.company) result = this.project.customer.company
            return result
        },
        customer_name(){
            let result = 'Name'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.name) result = this.project.customer.name
            return result
        },
        customer_address_1(){
            let result = 'address'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.address_1) result = this.project.customer.address_1
            return result
        },
        customer_address_2(){
            let result = 'address'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.address_2) result = this.project.customer.address_2
            return result
        },
        project(){
            return Project.project
        },
    },
    methods:{
        newProjectName(value){
            this.project.name = value
            updateProject()
        },
        newProjectDiscription(value){
            this.project.discription = value
            updateProject()
        },
        newProjectCustemer(name_feeld, value){
            if(!this.project.customer) this.project.customer = {}
            this.project.customer[name_feeld] = value
            updateProject()
        }
    }

}

</script>

<style scoped>
    .title-project{
        margin-top: 60px;
        margin-bottom: 100px;
        text-align: center;
    }
    .title-project .name{
        font-family: 'Raleway-Light';
        font-size: 36px;
        text-align: center;
        width: 100%;
    }
    .title-project .date{
        font-family: 'Comfortaa-Regular';
        font-size: 16px;
        color:#999999
    }

    .discription{
        margin-top: 30px;
        margin-bottom: 50px;
        column-gap: 15px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .content_discription{
        font-family: 'Raleway-Light';
        font-size: 20px;
        text-align: center;
        max-width: 1000px;
        color: #636363;
    }

    .title_discription{
        font-family: 'Raleway-Medium';
        font-size: 20px;
        color: #464646;
        text-align: center;
    }

    .customer{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;
        font-size: 18px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .title{
        border-bottom: 1px solid #7d7d7d;
        margin-bottom: 10px;
        /* width: 300px; */
        text-align: left;
    }
    .customer .content{
        font-family: 'Raleway-Light';
    }

    .payment_date{
        margin-top: -10px;
        text-align: right;
        display: flex;
        column-gap: 5px;
        justify-content: flex-end;
    }

    .light-text{
        font-size: 18px;
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .item_title_value{
        display: flex;
        justify-content: space-between;
    }

    .bold-text{
        font-size: 18px;
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

</style>
