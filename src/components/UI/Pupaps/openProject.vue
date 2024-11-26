<template>
    <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="wrap_content">
                <div class="projects_bills">
                    <div class="projects">
                        <div class="recent_projects">
                            <div class="title">Resent</div>
                            <div class="list">
                                <div class="item" v-for="item in list_resent" :key="item.id" @click="openProject(item.id)">{{ item.name }}</div>
                            </div>
                        </div>
                        <dic class="all_projects">
                            <div class="title">All Projects</div>
                            <div class="list">
                                <div class="item_all" v-for="item in list_all" :key="item.id" @click="openProject(item.id)">
                                    <div class="wrap_name_date">
                                        <div class="project_name">{{ item.name }}</div>
                                        <div class="finance_total">{{ `€ ${Math.trunc(item.total).toLocaleString("de-DE")}` }}</div>
                                    </div>
                                        <div class="date_created">{{ item.created.split(' ')[0] }}</div>
                                </div>
                            </div>
                        </dic>
                    </div>
                    <div class="bills"></div>
                </div>
                <div class="show_project"></div>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>


<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
import { global } from '@/servis/globalValues.js'
export default{
    name: 'openProject',
    mounted(){
        this.getData()
        EventBus.on('MenuProjects:open',this.openPopap)
    },
    data(){
        return {
            show:false,
            width:'1100px',
            height: '550px',
            list_resent:[],
            list_all:[],
        }
    },
    methods:{
        async getData(){
            if(!global.login) return false
            let result = (await apiData({typeData:'getProjects'})).data
            if(!result) return false
            this.list_all = result
            this.list_resent = result.sort((a,b)=>{
                a = new Date(a.updated); b = new Date(b.updated)
                if (a > b) return -1; if (a == b) return 0; if (a < b) return 1;
            })
        },
        close(){
            this.show=false
        },
        openPopap(){
            this.getData()
            this.show=true
        }, 
        openProject(id){
            EventBus.emit('Project:openProject', id)
            this.close()
        }
    }

}
</script>

<style scoped>
    .wrap_pupap{
        position: relative;
        z-index: 50;
    }
    .pupap{
        position: fixed;
        left: calc(100% / 2 - v-bind(width) / 2);
        top: calc(100vh / 2 - v-bind(height) / 2);
        width: v-bind(width);
        min-height: v-bind(height);
        background-color: #fff;
        border: 2px solid #D9D9D9;
        border-radius: 10px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .closeBtn{
        position: absolute;
        right: 7px;
        top: 7px;
        cursor: pointer;
    }

    .wrap_content{
        margin-top: 40px;
        margin-bottom: 40px;
        margin-left: 40px;
        margin-right: 40px;
    }

    .wrap_content{
        display: flex;
        height: calc( v-bind(height) - 80px );
    }

    .wrap_name_date{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .item_all{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .date_created{
        font-family: 'Comfortaa-Light';
        font-size: 14px;
        color: #9F9F9F;
    }

    .finance_total{
        font-family: 'Comfortaa-Light';
        font-size: 12px;
        color: #9F9F9F;
    }

    .projects_bills, .show_project{
        width: 50%;
    }

    .projects_bills{
        border-right: 1px solid #ADADAD;
    }

    .projects{
        display: flex;
    }

    .recent_projects, .all_projects{
        width: 50%; 
    }

    .all_projects{
        padding-right: 30px;
    }

    .title{
        width: 150px;
        font-family: 'Raleway-Light';
        font-size: 20px;
        color: #464646;
        padding-right: 20px;
        border-bottom: 1px solid #ADADAD;
        margin-bottom: 10px;
    }

    .list{
        font-family: 'Raleway-Light';
        font-size: 16px;
        color: #464646;
        cursor: pointer;
    }

    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color:#0000003b;
        z-index: 10;
    }

</style>