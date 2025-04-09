<template>
    <div class="wrap_admin_user">
        <div class="main-title">
            <div class="title">Projects</div>
            <div class="table">
                <div class="header">
                    <div class="collum collum_1">ID
                        <FilterData sortName="id" sortype="number" :list="list" @updated="value=>filter(value)"/>
                    </div>
                    <div class="collum collum_2">Date
                        <FilterData sortName="dateCreate"  sortype="date" :list="list" @updated="value=>filter(value)"/>
                    </div>
                    <div class="collum collum_3">User Email
                        <FilterData sortName="email" :list="list" @updated="value=>filter(value)"/>
                    </div>
                    <div class="collum collum_4">Name Project
                        <FilterData sortName="name" :list="list" @updated="value=>filter(value)"/>
                    </div>
                    <div class="collum collum_5">Status
                        <FilterData sortName="subscription"  sortype="date" right :list="list" @updated="value=>filter(value)"/>
                    </div>
                    <div class="collum collum_6">Link
                        <FilterData sortName="projects"  sortype="number" right :list="list" @updated="value=>filter(value)"/>
                    </div>
                </div>
                <div class="wrap_data" v-if="loaded">
                    <div class="data" v-for="item in filtredList" :key="item.id">
                        <div class="collum collum_1">{{ item.id }}</div>
                        <div class="collum collum_2">{{ item.created }}</div>
                        <div class="collum collum_3">{{ item.user }}</div>
                        <div class="collum collum_4">{{ item.name }}</div>
                        <div class="collum collum_5">{{ item.status }}</div>
                        <div class="collum collum_5">{{ !item.downLoad_token?'-':'link' }}</div>
                    </div>
                </div>
                <div v-else class="load">{{ text.Loading }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text'
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name:'AdminProjects',
    mounted(){
        this.initData()
        EventBus.on('AdminUsers:Update', this.initData)
    },
    data(){
        return{
            list:[],
            filtredList:[],
            loaded:false,
            text:{
                Loading: text.Calc.Loading,
            }
        }
    },
    methods:{
        async initData(){
            this.loaded = false
            let data = await apiData({typeData:'adminProjectData'})
            this.list = data.projects
            this.filtredList = data.projects
            this.loaded = true
        },
        filter(list){
            JSON.parse( JSON.stringify(list) )
            this.filtredList = list
        }
    }
}
</script>

<style scoped>
    .wrap_admin_user{
        min-height: 75vh;
        margin-bottom: 50px;
    }

    .title{
        margin-top: 60px;
        text-align: center;
        font-size: 36px;
        font-family: 'Raleway-Light';
        color: #2c3e50;
    }

    .table{
        margin-top: 40px;
        font-size: 16px;
        font-family: 'Raleway-Light';
        color: #2c3e50;
    }

    .header, .data{
        display: flex;
        column-gap: 5px;
    }

    .header .collum{
        text-align: center;
        background-color: #f8f8f8;
        border-radius: 2px;
    }

    .collum_1{
        min-width: 40px;
    }

    .collum_2{
        min-width: 180px;
    }

    .collum_3{
        padding-left: 5px;
        padding-right: 5px;
        min-width: 300px;
    }

    .collum_4{
        width: 378px;
    }

    .collum_5{
        width: 100px;
    }

    .collum_6{
        min-width: 130px;
    }

    .data .collum{
        margin-top: 10px;
        text-align: center;
        cursor: pointer;
    }

    .data .collum_4{
        padding-left: 5px;
        text-align: left;
    }

    .data .collum_3{
        padding-left: 5px;
        padding-right: 30px;
        text-align: left;
    }

    .header .collum:hover{
        color: #fff;
        background-color: #ebaa6c;
    }

    .header .collum:hover :deep(.hover_effect){
        visibility: visible!important;
    }

    .load{
        margin-top: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-family: 'Raleway-ExtraLight';
    }
</style>