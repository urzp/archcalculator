<template>
    <div class="title-project">
        <!-- <div class="name" >{{ project_name }}</div> -->
        <input type="text"  class="name" :value="project.name" @change="event=>newProjectName(event.target.value)"/>
        <div class="date">{{ created }}</div>
        <div class="discription">
            <!-- <div class="title_discription">Description:</div> -->
            <div class="content_discription">
                <ImputTextMLine width="1000px" :value="project.discription" @submit_event="value=>newProjectDiscription(value)"/>
            </div>
        </div>
        <div class="customer">
            <div class="title">Customer:</div>
            <div class="customer_company">
                <InputText :value="customer_company" width="200px" @submit_event="value=>newProjectCustemer('company', value)"></InputText>
            </div>
            <div class="customer_name">
                <InputText :value="customer_name" width="200px" @submit_event="value=>newProjectCustemer('name', value)"></InputText>
            </div>
            <div class="customer_name">
                <InputText :value="customer_address" width="200px" @submit_event="value=>newProjectCustemer('address', value)"></InputText>
            </div>
        </div>
    </div>
</template>

<script>
import { Project } from '@/servis/projectData';
import {  formatDate } from '@/servis/functions.js'
import {  updateProject } from '@/servis/projectData.js'
export default{
    name: 'CalcTitle',
    data(){
        return{
            
        }
    },
    computed:{
        created(){
            let result = ''
            if(!!this.project&&!!this.project.created){ result = formatDate(this.project.created)}
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
        customer_address(){
            let result = 'address'
            if(!!this.project&&!!this.project.customer&&!!this.project.customer.address) result = this.project.customer.address
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

</style>
