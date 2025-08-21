<template>
    <div class="wrap_admin_user"  v-if="!show_user">
        <div class="main-title">
            <div class="title">Tariffs</div>
        </div>
        <div class="table">
            <div class="header">
                <div class="collum collum_1">ID</div>
                <div class="collum collum_2">Title</div>
                <div class="collum collum_3">Amount Eur</div>
                <div class="collum collum_4">Time</div>
                <div class="collum collum_5">Servis</div>
                <div class="collum collum_6">Button Label</div>
                <div class="collum collum_7">Button Link</div>
            </div>
            <div class="wrap_data" v-if="loaded">
                <div class="data" v-for="item in filtredList" :key="item.id">
                    <div class="collum collum_1">{{ item.id }}</div>
                    <div class="collum collum_2"><InputText :value="item.title" :width="'180px'" @submit_event="value=>{update(item.id,'title', value)}" :autuClear="false"/></div>
                    <div class="collum collum_3"><InputText :value="item.price.value" :width="'100px'" @submit_event="value=>{update(item.id,'price_value', value)}" :autuClear="false"/></div>
                    <div class="collum collum_4"><InputText :value="item.price_period" :width="'200px'" @submit_event="value=>{update(item.id,'price_period', value)}" :autuClear="false"/></div>
                    <div class="collum collum_5">
                        <div class="small_font" v-for="item_serv in item.list_sevices" :key="item_serv.id"><InputText :value="item_serv.text" :width="'300px'" @submit_event="value=>{updateServis(item.id, item_serv.id, value)}" :autuClear="false"/></div>
                    </div>
                    <div class="collum collum_6"><InputText :value="ButtonLabel(item, 'label')" :width="'130px'" @submit_event="value=>{update(item.id,'label_button', value)}" :autuClear="false"/></div>
                    <div class="collum collum_7"><InputText :value="ButtonLabel(item, 'link')" :width="'200px'" @submit_event="value=>{update(item.id,'link_button', value)}" :autuClear="false"/></div>
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
        update(id, key ,value){
            if(key=='title') apiData({typeData:'tariffsUpdate', data:{id, key:'name', value}})
            if(key=='price_value') apiData({typeData:'tariffsUpdate', data:{id, key:'amount', value}})
            let data = this.list.find(item=>item.id==id)
            if(key=='price_value'){
                data.price.value = value
                data.price.curency = '€'
            }else if(key=='label_button'){
                if(data['button']===undefined) data.button = {}
                data.button.label = value
            }else if(key=='link_button'){
                if(data['button']===undefined) data.button = {} 
                data.button.link = value
            }else{
                data[key] = value
            }
            apiData({typeData:'tariffsUpdate', data:{id, key:'data', value: data}})
        },
        updateServis(id, id_servis ,value){
            let data = this.list.find(item=>item.id==id)
            let data_servis = data.list_sevices.find(item=>item.id==id_servis )
            data_servis.text = value
            apiData({typeData:'tariffsUpdate', data:{id, key:'data', value: data}})
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
        width: 180px;
        padding-left: 15px;
    }

    .collum_3{
        padding-left: 5px;
        padding-right: 5px;
        width: 100px;
    }

    .collum_4{
        padding-left: 5px;
        width: 200px;
    }

    .collum_5{
        width: 300px;
        text-align: left!important;
    }

    .header .collum_5{
        text-align: center!important;
    }

    .small_font{
        font-size: 14px;
    }

    .collum_6{
        width: 130px;
    }

    .collum_7{
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width: 200px;
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

    .data .collum_3{
        padding-left: 10px;
    }

    .data .collum_4{
        padding-left: 5px;
    }

    .data .collum_5{
        padding-left: 5px;
    }

    .data .collum_6{
        padding-left: 10px;
    }

    .data .collum_7{
        padding-left: 10px;
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