<template>
    <div class="title-project CalcTitle" >
        <!-- <div class="name" >{{ project_name }}</div> -->
        <template v-if="!bill_status">
        <input  type="text" v-if="!isShowProject"  class="name" :value="project_name" @change="event=>newProjectName(event.target.value)" @click="checkLock()"/>
        <div  v-else  class="name">{{ project_name }}</div>
        <div class="date">{{ created }}</div>
        <div class="discription">
            <!-- <div class="title_discription">Description:</div> -->
            <div class="content_discription">
                <ImputTextMLine v-if="!isShowProject"  :width="wideBody+'px'" :value="discription" @submit_event="value=>newProjectDiscription(value)" @click="checkLock()"/>
                <div v-else>{{ discription  }}</div>
            </div>
        </div>
        <div v-if="login&&!no_full_inf&&status_project!='calc'" class="customer">
            <div class="title">{{ text.Customer }}</div>
            <div class="customer">
                <InputText :value="customer_name" width="200px" @submit_event="value=>newProjectCustemer('name', value)" ></InputText>
            </div>
            <div class="customer">
                <InputText :value="customer_company" width="200px" @submit_event="value=>newProjectCustemer('company', value)" ></InputText>
            </div>
            <div class="customer">
                <InputText :value="customer_email" width="200px" @submit_event="value=>newProjectCustemer('email', value)" ></InputText>
            </div>
            <div class="customer">
                <InputText :value="customer_postcode" width="200px" @submit_event="value=>newProjectCustemer('postcode', value)" ></InputText>
            </div>
            <div class="customer">
                <InputText :value="customer_address" width="200px" @submit_event="value=>newProjectCustemer('address', value)" ></InputText>
            </div>
            <div class="customer">
                <InputText :value="customer_cityName" width="200px" @submit_event="value=>newProjectCustemer('cityName', value)" ></InputText>
            </div>
            <div class="customer">
                <InputText :value="customer_CountryID" width="200px" @submit_event="value=>newProjectCustemer('CountryID', value)" ></InputText>
            </div>
        </div>
        </template>
        <ProjBillHeader v-else/>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Project } from '@/servis/projectData';
import {  formatDate } from '@/servis/functions.js'
import {  updateProject } from '@/servis/projectData.js'
import { global } from '@/servis/globalValues.js'
import { checkLock } from '@/servis/projectData';
import { text } from '@/servis/text.js'
export default{
    name: 'CalcTitle',
    data(){
        return{
            tabSwitch:0,
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
        isShowProject(){
            let result = false
            if(!!this.$route.query&&!!this.$route.query.project) result = true
            return result
        },
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
        bill_status(){
            let result = false
            if(this.status_project=='bill') result = true
            //result = true // temp
            return result
        },
        customer_name(){
            let result = 'Name'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.name) result = this.project.customer.name
            return result
        },
        customer_company(){
            let result = 'Company'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.company) result = this.project.customer.company
            return result
        },
        customer_email(){
            let result = 'Email'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.email) result = this.project.customer.email
            return result
        },
        customer_postcode(){
            let result = 'Postcode'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.postcode) result = this.project.customer.postcode
            return result
        },
        customer_address(){
            let result = 'address'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.address) result = this.project.customer.address
            return result
        },
        customer_cityName(){
            let result = 'City Name'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.cityName) result = this.project.customer.cityName
            return result
        },
        customer_CountryID(){
            let result = 'Country ID'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.CountryID) result = this.project.customer.CountryID
            return result
        },
        project(){
            return Project.project
        },
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
        wideBody(){
           return global.wideBody
        }
    },
    methods:{
        async newProjectName(value){
            this.project.name = value
            await updateProject()
            EventBus.emit('SiteBar:Update')
        },
        newProjectDiscription(value){
            this.project.discription = value
            updateProject()
        },
        newProjectCustemer(name_feeld, value){
            if(!this.project.customer) this.project.customer = {}
            this.project.customer[name_feeld] = value
            updateProject()
        },
        checkLock(){
            checkLock()
        },
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

</style>
