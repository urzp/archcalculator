<template>
    <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div v-if="!loading&&!empty_list" class="wrap_content">
                <div class="projects_calendar">
                    <div class="projects">
                        <ListRecentProjects :list="list" @openProject="id=>openProject(id)" @showProject="id=>showProject = id"/>
                        <ListAllprojects :list="list" @openProject="id=>openProject(id)" @showProject="id=>showProject = id"/>
                    </div>
                    <div class="calendar_panel">
                        <ListDayProjects :list="list" :select_day="select_day" @openProject="id=>openProject(id)" @showProject="id=>showProject = id" />
                        <Calendar :selectDay="select_day" :projects="list" @selectDay="day=>select_day=day"/>
                    </div>
                </div>
                <ShowProject :id_project="showProject"  @openProject="id=>openProject(id)" @deleteProject="id=>deleteProject(id)" @softReload="softReload=true"/>
            </div>
            <div v-else-if="loading" class="loading">{{ text.loading }}</div>
            <div v-else class="empty_list_projects">{{ text.No_selected_project }}</div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>


<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
import { global } from '@/servis/globalValues.js'
import { text } from '@/servis/text.js'
export default{
    name: 'openProject',
    mounted(){
        this.getData()
        EventBus.on('MenuProjects:open',this.openPopap)
        EventBus.on('MenuProjects:reload',this.getData)
        if(global.openPopapProjects){global.openPopapProjects=false; this.openPopap()}
    },
    data(){
        return {
            show:false,
            width:'1100px',
            height: '750px',
            list:[],
            loading: false,
            showProject:'',
            select_day: new Date(),
            softReload: false,
            text:{
                loading: text.openProject.loading,
                No_selected_project: text.openProject.No_selected_project,
            }
        }
    },
    computed:{
        empty_list(){
            return this.list.length == 0
        }
    },
    methods:{
        async getData(type='all'){
            this.loading = true
            if(!global.login) return false
            let result = (await apiData({typeData:'getProjects', type})).data
            this.loading = false
            if(!result) return false
            this.list = result
        },
        close(){
            document.documentElement.style.overflow = 'auto'
            if(this.softReload){ this.softReload = false; EventBus.emit('MenuProjects:reload') }
            this.show=false
        },
        openPopap(type='all'){
            if(this.goToCalcPage()) return false
            document.documentElement.style.overflow = 'hidden'
            this.getData(type)
            this.show=true
        }, 
        openProject(id){
            EventBus.emit('Project:openProject', id)
            this.close()
        },
        async deleteProject(id){
            await apiData({typeData:'deleteProject', id})
            this.showProject = ''
            this.getData()
            if(localStorage.getItem('OpendProject') == id){
                EventBus.emit('MenuProjects:new')
            }
        },
        goToCalcPage(){
            if( this.$route.path!='/' ){
                global.openPopapProjects = true
                this.$router.push({ name: 'home' })
                return true
            }
            return false
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
        border: 2px solid #e2e2e2;
        border-radius: 10px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .closeBtn{
        position: absolute;
        right: 7px;
        top: 7px;
        cursor: pointer;
    }

    .loading, .empty_list_projects{
        display: flex;
        height: v-bind(height);
        justify-content: center;
        align-items: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
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

    .projects_calendar, .show_project{
        width: 50%;
    }

    .projects_calendar{
        border-right: 1px solid #e2e2e2;
    }

    .projects{
        display: flex;
        padding-bottom: 20px;
        margin-right: 40px;
        border-bottom: 1px solid #e2e2e2;
        min-height: 330px;
    }

    .recent_projects{
        width: 50%;
    }

    .title{
        width: 150px;
        font-family: 'Raleway-Light';
        font-size: 20px;
        color: #464646;
        padding-right: 20px;
        border-bottom: 1px solid #e2e2e2;
        margin-bottom: 10px;
    }

    .list{
        margin-right: 20px;
        font-family: 'Raleway-Light';
        font-size: 16px;
        color: #5B5B5B;
        cursor: pointer;
    }

    .item{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .calendar_panel{
        margin-top: 40px;
        margin-right: 40px;
        display: flex;
        min-height: 300px;
        justify-content: space-between;
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