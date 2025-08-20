<template>
    <div  class="wrap_sitebar" :class="{'open':config.open}">
        <ButtonSiteBar :open="config.open" @click=" config.open=!config.open "/>
        <div class="slide_bar">
            <div class="item_level_0 calcs">
                <div class="title" @click="config.calcs=!config.calcs"><Marker :level="0"/> {{ text.Calc }}</div>
                <div v-if="config.calcs" class="content">
                    <Item_level_1 :title="text.NewCalc" @click="newCalc()" />
                    <Item_level_1 :title="text.LastCalcs"/>
                    <Item_level_1 v-for="item, index in calcs" :key="item.id" :active="id_current_project==item.id" :project_data="item" :marker_type="'1'" :unavailable="!isTariffActive&&index!=0"/>
                    <Item_level_1 :title="text.OpenCalcs" @click="openProjects('calc')" :unavailable="!isTariffActive"/>
                </div>
            </div>
            <div class="item_level_0 offers">
                <div class="title" @click="config.offers=!config.offers"><Marker :level="0"/> {{ text.Offer }}</div>
                <div v-if="config.offers" class="content" >
                    <Item_level_1 v-if="poject_status=='calc'" :title="text.NewOffer" @click="newOffer()" :unavailable="!isTariffActive"/>
                    <Item_level_1 :title="text.LastOffer" :unavailable="!isTariffActive"/>
                    <Item_level_1 v-for="item in offers" :key="item.id" :active="id_current_project==item.id" :project_data="item"  :marker_type="'1'" :unavailable="!isTariffActive"/>
                    <Item_level_1 :title="text.OpenOffer" @click="openProjects('offer')" :unavailable="!isTariffActive"/>
                </div>            
            </div>
            <div class="item_level_0 projects">
                <div class="title" @click="config.projects=!config.projects"><Marker :level="0"/> {{ text.Project }}</div>
                <div v-if="config.projects" class="content" >
                    <Item_level_1 :title="text.NewProject" @click="newProject()" :unavailable="!isTariffActive"/>
                    <Item_level_1 v-if="poject_status=='offer'" :title="text.OfferAsProject" @click="OfferAsProject()"  :unavailable="!isTariffActive"/>
                    <Item_level_1 :title="text.Projects" :unavailable="!isTariffActive"/>
                    <Item_level_1 v-for="item in projects" :active="id_current_project==item.id" :key="item.id" :project_data="item"  :marker_type="'0'" bills :unavailable="!isTariffActive"/>
                    <Item_level_1 :title="text.OpenProject" @click="openProjects('project')" :unavailable="!isTariffActive"/>
                </div>              
            </div>
        </div>
    </div>
    <div v-if="config.open" class="close_panel" @click=" config.open=false "></div>
</template>

<script>
import {text} from '@/servis/text'
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
import { Project, newStatus, updateProject } from '@/servis/projectData.js'
import { global } from '@/servis/globalValues.js'
export default{
    name: 'SiteBar',
    mounted(){
        this.initConfig()
        this.initData()
        EventBus.on('SiteBar:Update', this.initData)  
    },
    data(){
        return{
            config:{
                open: true,
                calcs: true,
                offers: true,
                projects: true,
            },
            calcs:[],
            offers:[],
            projects:[],
            text:{
                Calc: text.sideBar.Calc,
                NewCalc: text.sideBar.NewCalc,
                LastCalcs: text.sideBar.LastCalcs,
                OpenCalcs: text.sideBar.OpenCalcs,

                Offer: text.sideBar.Offer,
                NewOffer: text.sideBar.NewOffer,
                LastOffer: text.sideBar.LastOffer,
                OpenOffer: text.sideBar.OpenOffer,    
                
                Project: text.sideBar.Project,
                NewProject: text.sideBar.NewProject,
                OfferAsProject: text.sideBar.OfferAsProject,
                OpenProject: text.sideBar.OpenProject,     
                
                Projects: text.sideBar.Projects,
            }
        }
    },
    watch:{
        config:{
            handler(){
                localStorage.setItem('sideBarConf', JSON.stringify(this.config))
            },
            deep: true,
        }
    },
    computed:{
        poject_status(){
            let result = 'calc'
            if(!!Project&&!!Project.project&&!!Project.project.status) result = Project.project.status
            return result
        },
        id_current_project(){
            let result = ''
            if(!!Project&&!!Project.project&&!!Project.project.id){
                result = Project.project.id
                if(Project.project.status=="bill") result = Project.project.id_project_contract
            } 
            return result
        },
        isTariffActive(){
            let result = global.isTariffActive
            return result
        }
    },
    methods:{
        initConfig(){
            let data = JSON.parse(localStorage.getItem('sideBarConf'))
            if(!!data) this.config = data
            if(!data) localStorage.setItem('sideBarConf', JSON.stringify(this.config))
        },
        async initData(){
            let data = await apiData({typeData:'siteBarData'})
            this.calcs = data.calcs
            this.offers = data.offers
            this.projects = data.projects
            if(!this.isTariffActive){ this.switchNoActivTariff() } 
        },
        switchNoActivTariff(){
            if( this.calcs.length>0 ){
                EventBus.emit('MenuProjects:closeBills')
                EventBus.emit('Project:openProject', this.calcs[0].id)
            }else{
                this.newCalc()
            }
        },
        messageUpdateTarrif(){
            console.log('updatTariff')
        },
        async newCalc(){
            await EventBus.emit('MenuProjects:new')
            await updateProject()
            this.initData()
        },
        async newOffer(){
            if(!this.isTariffActive){this.messageUpdateTarrif(); return false}
            await newStatus('offer')
            this.initData()
        },
        async OfferAsProject(){
            if(!this.isTariffActive){this.messageUpdateTarrif(); return false}
            await newStatus('project')
            this.initData()            
        },
        async newProject(){
            if(!this.isTariffActive){this.messageUpdateTarrif(); return false}
            await EventBus.emit('MenuProjects:new', 'project')
            await updateProject()
            this.initData()       
        },
        openProjects(type){
            if(!this.isTariffActive){this.messageUpdateTarrif(); return false}
            this.config.open=false
            EventBus.emit('MenuProjects:open', type)
        }
    }
}
</script>

<style scoped>
.wrap_sitebar{
    width: 350px;
    height: 100%;
    padding-top: 65px;
    padding-left: 25px;
    position: fixed;
    left: -355px;
    z-index: 100;
    background-color: #D9D9D9;
    box-shadow: 8px 0 8px rgba(0, 0, 0, 0.25);
    transition: transform 0.5s;
    color: #464646;
}

.slide_bar{
    overflow-y: auto;
    height: 100%;
}

.title{
    display: flex;
    column-gap: 5px;
    align-self: center;
    font-family: 'Raleway-Bold';
    font-size: 20px;
    cursor: pointer;
}

.open{
    transition: transform 0.5s;
    transform: translate(355px);
}

.item_level_0{
    margin-bottom: 15px;
}

.close_panel{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
}

.inActive{
    opacity: 0.3;
}
</style>