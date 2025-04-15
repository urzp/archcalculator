<template>

    <div class="main-title">
        <LeftButton @click="$emit('close')"/>
        <div class="title">Projects of {{ user_name }}</div>
    </div>
    <div class="table">
        <div class="header">
            <div class="collum collum_1">ID
                <FilterData sortName="id" sortype="number" :list="list" @updated="value=>filter(value)"/>
            </div>
            <div class="collum collum_2">Date
                <FilterData sortName="created"  sortype="date" :list="list" @updated="value=>filter(value)"/>
            </div>
            <div class="collum collum_3">Name Project
                <FilterData sortName="name" :list="list" @updated="value=>filter(value)"/>
            </div>
            <div class="collum collum_4">Status
                <FilterData sortName="status" :list="list" @updated="value=>filter(value)"/>
            </div>
            <div class="collum collum_5">Bills
                <FilterData sortName="bills_count"  right :list="list" @updated="value=>filter(value)"/>
            </div>
            <div class="collum collum_6">Link
                <FilterData sortName="downLoad_token"  sortype="number" right :list="list" @updated="value=>filter(value)"/>
            </div>
        </div>
        <div class="wrap_data" v-if="loaded">
            <div class="data" v-for="item in filtredList" :key="item.id" @click="selected_project=item; filtredList_2=item.bills">
                <div class="collum collum_1">{{ item.id }}</div>
                <div class="collum collum_2">{{ item.created }}</div>
                <div class="collum collum_3">{{ item.name }}</div>
                <div class="collum collum_4">{{ item.status }}</div>
                <div class="collum collum_5">{{ item.bills_count }}</div>
                <div class="collum collum_6">
                    <a :href="setLink(item.id, item.downLoad_token)" v-if="!!item.downLoad_token" target="_blank">open</a>
                    <div v-else>-</div>  
                </div>
            </div>
        </div>
        <div v-else class="load">{{ text.Loading }}</div>
    </div>

    <!-- ---------------------------------------bills----------------------------------------  -->

    <div v-if="selected_project.bills_count>0" class="main-title">
        <div class="title">Bills of {{ selected_project.name }}</div>
    </div>
    <div v-if="selected_project.bills_count>0" class="table">
        <div class="header">
            <div class="collum collum_1">ID
                <FilterData sortName="id" sortype="number" :list="selected_project.bills" @updated="value=>filter_2(value)"/>
            </div>
            <div class="collum collum_2">Date
                <FilterData sortName="created"  sortype="date" :list="selected_project.bills" @updated="value=>filter_2(value)"/>
            </div>
            <div class="collum collum_3">Name
                <FilterData sortName="name" :list="selected_project.bills" @updated="value=>filter_2(value)"/>
            </div>
            <div class="collum collum_4">Status
                <FilterData sortName="locked" :list="selected_project.bills" @updated="value=>filter_2(value)"/>
            </div>
            <div class="collum collum_5">Paid
                <FilterData sortName="paid_date" sortype="date"  right :list="selected_project.bills" @updated="value=>filter_2(value)"/>
            </div>
            <div class="collum collum_6">Link
                <FilterData sortName="downLoad_token"  sortype="number" right :list="selected_project.bills" @updated="value=>filter_2(value)"/>
            </div>
        </div>
        <div class="wrap_data" v-if="loaded">
            <div class="data" v-for="item in filtredList_2" :key="item.id" >
                <div class="collum collum_1">{{ item.id }}</div>
                <div class="collum collum_2">{{ item.created }}</div>
                <div class="collum collum_3">{{ item.name }}</div>
                <div class="collum collum_4">{{ item.locked=="1"?'locked':'open' }}</div>
                <div class="collum collum_5">{{ formatDate(item.paid_date) }}</div>
                <div class="collum collum_6">
                    <a :href="setLink(item.id, item.downLoad_token)" v-if="!!item.downLoad_token" target="_blank">open</a>
                    <div v-else>-</div>  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text'
import { formatDate } from '@/servis/functions'
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name:'AdminUserProjects',
    mounted(){
        this.initData()
        EventBus.on('AdminUsers:Update', this.initData)
    },
    data(){
        return{
            list:[],
            filtredList:[],
            filtredList_2:[],
            loaded:false,
            selected_project:'',
            text:{
                Loading: text.Calc.Loading,
            }
        }
    },
    emits:['close'],
    props:{
        user_id:[String, Number],
        user_name:String,
    },
    methods:{
        async initData(){
            this.loaded = false
            let data = await apiData({typeData:'adminUserProjects', id:this.user_id})
            this.list = data.projects
            this.filtredList = data.projects
            this.loaded = true
        },
        filter(list){
            JSON.parse( JSON.stringify(list) )
            this.filtredList = list
        },
        filter_2(list){
            JSON.parse( JSON.stringify(list) )
            this.filtredList_2 = list
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
        formatDate(value){
           return formatDate(value)
        }
    }
}
</script>

<style scoped>
    .wrap_admin_user{
        min-height: 75vh;
        margin-bottom: 50px;
    }

    .main-title{
        margin-top: 60px;
        display: flex;
        text-align: center;
        margin-bottom: 100px;
    }

    .title{
        display: flex;
        width: 100%;
        justify-content: center;
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
        min-width: 500px;
    }

    .collum_4{
        width: 100px;
    }

    .collum_5{
        min-width: 130px;
    }

    .collum_6{
        width: 100px;
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