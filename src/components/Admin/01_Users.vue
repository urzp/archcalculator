<template>
    <div class="wrap_admin_user" v-if="!show_user">
        <div class="main-title">
            <div class="title">Users</div>
        </div>
        <div class="table">
            <div class="header">
                <div class="collum collum_1">ID
                    <FilterData sortName="id" sortype="number" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_2">Registration
                    <FilterData sortName="dateCreate"  sortype="date" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_3">
                    <div class="left">Email
                        <FilterData sortName="email" :list="list" @updated="value=>filter(value)"/>
                    </div>
                    <div class="right">Confirmed
                    </div>
                </div>
                <div class="collum collum_4">Name
                    <FilterData sortName="name" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_5">Subscription
                    <FilterData sortName="subscription"  sortype="date" right :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_6">Projects
                    <FilterData sortName="projects"  sortype="number" right :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_7">Contracts
                    <FilterData sortName="contracts"  sortype="number" right :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_8">Bills
                    <FilterData sortName="bills"  sortype="number" right :list="list" @updated="value=>filter(value)"/>
                </div>
            </div>
            <div class="wrap_data" v-if="loaded">
                <div class="data" v-for="item in filtredList" :key="item.id" @click="openUser(item.id)">
                    <div class="collum collum_1">{{ item.id }}</div>
                    <div class="collum collum_2">{{ item.dateCreate }}</div>
                    <div class="collum collum_3">
                        <div class="left">{{ item.email }}</div>
                        <div class="right">{{ item.email_confirmed=='1'?'Y':' - ' }}</div>
                    </div>
                    <div class="collum collum_4">{{ item.name }}</div>
                    <div class="collum collum_5">{{ item.subscription }}</div>
                    <div class="collum collum_6">{{ item.projects }}</div>
                    <div class="collum collum_7">{{ item.contracts }}</div>
                    <div class="collum collum_8">{{ item.bills }}</div>
                </div>
            </div>
            <div v-else class="load">{{ text.Loading }}</div>
        </div>
    </div>
    <AdminProfileUser v-else :user_id="user_id" @close="show_user=false"></AdminProfileUser>
</template>

<script>
import { text } from '@/servis/text'
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name:'AdminUsers',
    mounted(){
        this.initData()
        EventBus.on('AdminUsers:Update', this.initData)
    },
    data(){
        return{
            show_user:false,
            user_id:'',
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
            let data = await apiData({typeData:'adminUserData'})
            this.list = data.users
            this.filtredList = data.users
            this.loaded = true
        },
        filter(list){
            JSON.parse( JSON.stringify(list) )
            this.filtredList = list
        },
        openUser(id){
            this.user_id = id
            this.show_user = true
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
        background-color: #f0e9d0;
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
        display: flex;
        justify-content: space-between;
    }

    .collum_4{
        width: 240px;
    }

    .collum_5{
        width: 200px;
    }

    .collum_6{
        min-width: 75px;
    }

    .collum_7{
        min-width: 75px;
    }

    .collum_8{
        min-width: 75px;
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
        justify-content: space-between;;
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