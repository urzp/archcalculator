<template>
    <div class="wrap_admin_user"  v-if="!show_user">
        <div class="main-title">
            <div class="title">Tariffs</div>
        </div>
        <div class="table">
            <div class="header">
                <div class="collum collum_1">ID
                    <FilterData sortName="id" sortype="number" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_2">Title
                    <FilterData sortName="title" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_3">Amount Eur
                    <FilterData sortName="title" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_4">Time
                    <FilterData sortName="title" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_5">Servis
                    <FilterData sortName="title" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_6">Button Label
                    <FilterData sortName="title" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_7">Button Link
                    <FilterData sortName="title" :list="list" @updated="value=>filter(value)"/>
                </div>
                <!-- <div class="collum collum_2">Date
                    <FilterData sortName="created"  sortype="date" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_3">User Email
                    <FilterData sortName="user" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_4">Name
                    <FilterData sortName="name" :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_5">Name Project
                    <FilterData sortName=""  right :list="list" @updated="value=>filter(value)"/>
                </div>
                <div class="collum collum_6">Link
                    <FilterData sortName="downLoad_token"  sortype="number" right :list="list" @updated="value=>filter(value)"/>
                </div> -->
            </div>
            <div class="wrap_data" v-if="loaded">
                <div class="data" v-for="item in filtredList" :key="item.id">
                    <div class="collum collum_1">{{ item.id }}</div>
                    <div class="collum collum_2">{{ item.title }}</div>
                    <div class="collum collum_3">{{ item.price.value }}</div>
                    <div class="collum collum_4">{{ item.price_period }}</div>
                    <div class="collum collum_5">
                        <div class="small_font" v-for="item_serv in item.list_sevices" :key="item_serv.id">{{ item_serv.text }}</div>
                    </div>
                    <div class="collum collum_6">{{ ButtonLabel(item, 'label') }}</div><div class="edition">edit</div>
                    <div class="collum collum_7">{{ ButtonLabel(item, 'link') }}</div>
                    <!-- <div class="collum collum_2">{{ item.created }}</div>
                    <div class="collum collum_3" @click="openUser(item.user_id)" :class="{'no_pointer':item.user_id=='-1'}">{{ item.user }}</div>
                    <div class="collum collum_4">{{ item.name }}</div>
                    <div class="collum collum_5">{{ item.name_project }}</div>
                    <div class="collum collum_6">
                        <a :href="setLink(item.id, item.downLoad_token)" v-if="!!item.downLoad_token" target="_blank">open</a>
                        <div v-else>-</div>  
                    </div> -->
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
    name:'AdminTariffs',
    mounted(){
        this.initData()
        EventBus.on('AdminUsers:Update', this.initData)
    },
    data(){
        return{
            list:[],
            filtredList:[],
            loaded:false,
            user_id:'',
            show_user: false,
            text:{
                Loading: text.Calc.Loading,
            }
        }
    },
    methods:{
        async initData(){
            this.loaded = false
            let result = (await apiData({typeData:'tariffs'})).data
            this.list = result
            this.filtredList = result
            this.loaded = true
        },
        filter(list){
            JSON.parse( JSON.stringify(list) )
            this.filtredList = list
        },
        openUser(id){
            if(id=="-1") return false
            this.user_id = id
            this.show_user = true
        }, 
        setLink(id,token){
            let url=`https://honorar.online?project=${id}&download_token=${token}`
            return url
        },
        ButtonLabel(item, subItem){
            let result = "-"
            if(!!item.button&&!!item.button[subItem]) result = item.button[subItem]
            return result
        },
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
        min-width: 100px;
    }

    .collum_4{
        width: 200px;
    }

    .collum_5{
        width: 300px;
        text-align: left!important;
    }

    .small_font{
        font-size: 14px;
    }

    .collum_6{
        min-width: 130px;
    }

    .collum_7{
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width: 200px;
    }

    .edition{
        position: relative;
        width: 0;
    }

    .data .collum{
        margin-top: 10px;
        text-align: center;
        cursor: pointer;
    }

    .data .collum_3{
        padding-left: 5px;
        padding-right: 30px;
        text-align: left;
    }

    .data .collum_1{
        cursor: default!important;
    }

    .data .collum_2{
        cursor: default!important;
    }


    .data .collum_4{
        padding-left: 5px;
        text-align: left;
        cursor: default!important;
    }

    .data .collum_5{
        cursor: default!important;
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
    .no_pointer{
        cursor: default!important;
    }
</style>