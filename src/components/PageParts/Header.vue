<template>
    <div class="header">
        <div class="header-row">
            <div class="logo">
                <img v-if="!global.login" src="@/assets/imgs/logo.svg" alt="">
                <div v-else-if="!user.avatar" class="userLogo" @click="$router.push({ name: 'profile' })">{{ !user.name?'U':user.name[0] }}</div>
                <div v-else class="userLogo" @click="$router.push({ name: 'profile' })"><img :src="url_avatar" alt=""></div>
            </div>
            <div class="menu">
                <div v-if=" this.$route.path!='/'" class="item_menu" @click="$router.push({ name: 'home' })">Calculator</div>
                <div class="item_menu">Über honorar.online</div>
                <div class="item_menu">Anleitung</div>
                <div v-if="global.admin" class="item_menu" @click="$router.push({ name: 'law_edit_data' })">Edit HOAI version</div>
            </div>
            <div class="btn_menu" @click="show_menu=!show_menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <Menu :show="show_menu" @close="show_menu=false"></Menu>
        </div>
        <div class="sub-header">
            <div class="left_side">
                <div v-if="show_bills" class="item_subHeader" @click="showBills(false)">Projects</div>
                <template v-else>
                <div class="item_subHeader" @click="newProject()">Neues Projekt</div>
                <div v-if="unsaved" class="item_subHeader" @click="saveProject()">Einfamilienhaus</div>
                <div v-if="hasLocalUnsaved&&!unsaved&&this.global.login" class="item_subHeader" @click="openLocalProject()">Nicht gespeichertes Projekt öffnen</div>
                <div class="item_subHeader" @click="openProject()">Projekt öffnen</div>
                </template>
            </div>
            <div class="right_side">
                <template v-if="show_bills">
                <div class="item_subHeader" @click="console.log('open bills')">New Project Bill</div>
                </template>
                <div v-else class="item_subHeader" @click="showBills(true)">Bills</div>
            </div>
        </div>
    </div>
    <Popaps/>
</template>


<script>
import { EventBus } from '@/servis/EventBus'
import { global, user } from '@/servis/globalValues.js'
import { saveNewProject } from '@/servis/projectData.js'
import { Project } from '@/servis/projectData.js'
export default{
    name: 'Header',
    async mounted(){
        await this.getData()
        if(global.newProject) {global.newProject=false; this.newProject()}
        this.chekLocalUnsaved()
        EventBus.on('Project:openProject',this.chekLocalUnsaved)
        EventBus.on('Menu:logOut',()=>{ this.showBills(false)})
    },
    data(){
        return {
            isAdmin:false,
            global:{},
            user:{},
            show_menu:false,
            hasLocalUnsaved:false,
            show_bills:false,
        }
    },
    computed:{
        url_avatar(){
            let url = `${global.base_url}/users/user_${this.user.id}/avatar/${this.user.avatar}`
            return url
        },
        unsaved(){
            if(!Project.project) return false
            return Project.project.unsaved
        },
    },
    methods:{
        getData(){
            this.global = global
            this.user = user
        },
        newProject(){
            if(this.goToCalcPage()) return false
            let localProject = localStorage.getItem('Project') 
            if(!!localProject&&JSON.parse(localProject).project.unsaved ){
                EventBus.emit('Popap:comfirm',{
                    title:'Das aktuelle Projekt wurde nicht gespeichert, dennoch weitermachen?',
                    action: async ()=>{ EventBus.emit('MenuProjects:new') },
                })
                return true
            }
            EventBus.emit('MenuProjects:new')
        },
        openProject(){
            if(global.login) EventBus.emit('MenuProjects:open')
            if(!global.login) EventBus.emit('Menu:Login', ()=>{EventBus.emit('MenuProjects:open')})
        },
        saveProject(){
            if(!global.login){ EventBus.emit('Menu:Login', saveNewProject); return false }
            Project.project.unsaved = false
            saveNewProject()
            this.hasLocalUnsaved = false
        },
        openLocalProject(){
            EventBus.emit('MenuProjects:openLocal')
        },
        showBills(value){
            if(value){
                if(global.login){ this.show_bills=value; EventBus.emit('MenuProjects:showBills') }
                if(!global.login) EventBus.emit('Menu:Login', ()=>{this.show_bills=true; EventBus.emit('MenuProjects:showBills')})  
            }else{
                this.show_bills=value
                EventBus.emit('MenuProjects:closeBills')
            }          
        },
        goToCalcPage(){
            if( this.$route.path!='/' ){
                global.newProject = true
                this.$router.push({ name: 'home' })
                return true
            }
            return false
        },
        chekLocalUnsaved(){
            let localProject = JSON.parse( localStorage.getItem('Project') )
            if(!localProject) return false
            let id = localProject.project.id
            this.hasLocalUnsaved = (id=='new'||id=='local')&&localProject.project.unsaved
        }
    },
}
</script>


<style scoped>
    .header-row{
        height: 110px;
        display: flex;
        align-items: center;
        border-bottom: solid 1px #999999;
    }
    .menu{
        width: 100%;
        margin-right: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        column-gap: 100px;
    }
    .logo{
        cursor: pointer;
    }
    .userLogo{
        width: 63px;
        height: 63px;
        border-radius: 33px;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        font-family: 'Comfortaa-Light';
        font-size: 35px;
        color: #5A5A5A;
        background-color: #EFEFEF;
    }

    .userLogo img{
        width: 100%;
        height: 100%; 
        border-radius: 50%;
        object-fit: cover;
    }

    .menu .item_menu{
        font-family: 'Raleway-ExtraLight';
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition-hover);
    }
    .menu .item_menu:hover{
        color: var(--color-akcent);
        font-family: 'Raleway-Light';
        transition: var(--transition-hover);
    }

    .btn_menu{
        width: 50px;
        height: 30px;
        cursor: pointer;
    }

    .btn_menu .line{
        height: 10px;
        width: 100%;
        border-bottom: 1px solid #999;
    }

    .btn_menu:hover .line{
        border-bottom: 2px solid var(--color-akcent);
    }

    .sub-header{
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        color: #999999;
        cursor:pointer;
    }

    .left_side, .right_side{
        display: flex;      
        column-gap: 50px; 
    }

</style>