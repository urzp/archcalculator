<template>
    <div class="wrap_admin_user"  v-if="!show_user">
        <div class="main-title">
            <div class="title">Setings</div>
        </div>
        <div class="table">
            <div class="header">
                <div class="collum collum_1">ID</div>
                <div class="collum collum_2">Name</div>
                <div class="collum collum_3">Value</div>
                <div class="collum collum_4">Discription</div>
            </div>
            <div class="wrap_data" v-if="loaded">
                <div class="data" v-for="item in filtredList" :key="item.id">
                    <div class="collum collum_1">{{ item.id }}</div>
                    <div class="collum collum_2"><InputText :value="item.name" :width="'250px'" @submit_event="value=>{update(item.id,'name', value)}" :autuClear="false"/></div>
                    <div class="collum collum_3"><InputText :value="item.value" :width="'400px'" @submit_event="value=>{update(item.id,'value', value)}" :autuClear="false"/></div>
                    <div class="collum collum_4"><InputText :value="item.description" :width="'400px'" @submit_event="value=>{update(item.id,'description', value)}" :autuClear="false"/></div>
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
    name:'AdminSetings',
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
            let result = (await apiData({typeData:'AdminGetSettings'})).data
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
        update(id, key ,value){
            apiData({typeData:'AdminUpdateSettings', data:{id, key, value}})
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
        width: 40px;
        cursor: default!important;
    }

    .collum_2{
        width: 250px;
        padding-left: 15px;
    }

    .collum_3{
        padding-left: 5px;
        padding-right: 5px;
        width: 400px;
    }

    .collum_4{
        padding-left: 5px;
        width: 400px;
    }



    .small_font{
        font-size: 14px;
    }


    .edition{
        cursor: url('@/assets/icons/pen_icon/main.svg'), auto!important;
    }

    .edition:hover{
        opacity: 0.5;
    }

    .data .collum{
        margin-top: 10px;
        text-align: center;
        cursor: pointer;
    }

    .data .collum_2{
        padding-left: 15px;
    }

    .data .collum_3{
        padding-left: 15px;
    }

    .data .collum_4{
        padding-left: 15px;
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