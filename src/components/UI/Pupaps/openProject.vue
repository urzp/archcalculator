<template>
    <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div v-if="!loading" class="wrap_content">
                <div class="projects_bills">
                    <div class="projects">
                        <ListRecentProjects :list="list" @openProject="id=>openProject(id)" @showProject="id=>showProject = id"/>
                        <ListAllprojects :list="list" @openProject="id=>openProject(id)" @showProject="id=>showProject = id"/>
                    </div>
                    <div class="bills"></div>
                </div>
                <ShowProject :id_project="showProject"/>
            </div>
            <div v-else class="loading">Loading . . .</div>
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
            height: '750px',
            list:[],
            loading: false,
            showProject:'',
        }
    },
    methods:{
        async getData(){
            this.loading = true
            if(!global.login) return false
            let result = (await apiData({typeData:'getProjects'})).data
            this.loading = false
            if(!result) return false
            this.list = result
        },
        close(){
            document.documentElement.style.overflow = 'auto'
            this.show=false
        },
        openPopap(){
            document.documentElement.style.overflow = 'hidden'
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

    .loading{
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

    .projects_bills, .show_project{
        width: 50%;
    }

    .projects_bills{
        border-right: 1px solid #e2e2e2;
    }

    .projects{
        display: flex;
        padding-bottom: 20px;
        margin-right: 40px;
        border-bottom: 1px solid #e2e2e2;
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