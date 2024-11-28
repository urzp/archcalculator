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
                <div class="item_menu">About project</div>
                <div class="item_menu">How to use</div>
                <div v-if="global.admin" class="item_menu" @click="$router.push({ name: 'law_edit_data' })">Edit HOAI version</div>
            </div>
            <div class="btn_menu" @click="show_menu=!show_menu"></div>
            <Menu :show="show_menu" @close="show_menu=false"></Menu>
        </div>
        <div class="sub-header">
            <div class="item_subHeader" @click="newProject()">New Project</div>
            <div class="item_subHeader" @click="openProject()">Open Project</div>
            <div v-if="this.global.saveNewProject" class="item_subHeader" @click="saveProject()">Save Project</div>
        </div>
    </div>
    <Popaps/>
</template>


<script>
import { EventBus } from '@/servis/EventBus'
import { global, user } from '@/servis/globalValues.js'
import { saveNewProject } from '@/servis/projectData.js'
export default{
    name: 'Header',
    async mounted(){
        await this.getData()
        if(global.newProject) {global.newProject=false; this.newProject()}
    },
    data(){
        return {
            isAdmin:false,
            global:{},
            user:{},
            show_menu:false,
        }
    },
    computed:{
        url_avatar(){
            let url = `${global.base_url}/users/user_${this.user.id}/avatar/${this.user.avatar}`
            return url
        }
    },
    methods:{
        getData(){
            this.global = global
            this.user = user
        },
        newProject(){
            if(this.goToCalcPage()) return false
            if(global.login) global.saveNewProject = true
            EventBus.emit('MenuProjects:new')
        },
        openProject(){
            if(global.login) EventBus.emit('MenuProjects:open')
            if(!global.login) EventBus.emit('Menu:Login')
        },
        saveProject(){
            global.saveNewProject = false
            saveNewProject()
        },
        goToCalcPage(){
            if( this.$route.path!='/' ){
                global.newProject = true
                this.$router.push({ name: 'home' })
                return true
            }
            return false
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
        background-image: url('@/assets/icons/btn_menu/main.svg');
        background-repeat: no-repeat;
        transition: var(--transition-hover);
    }

    .btn_menu:hover{
        background-image: url('@/assets/icons/btn_menu/active.svg');
        transition: var(--transition-hover);
    }

    .sub-header{
        margin-top: 15px;
        display: flex;
        column-gap: 50px;
        font-size: 'Raleway-ExtraLight';
        font-size: 16px;
        color: #999999;
        cursor:pointer;
    }

</style>