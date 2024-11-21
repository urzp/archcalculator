<template>
    <div class="header">
        <div class="header-row">
            <div class="logo">
                <img v-if="!global.login" src="@/assets/imgs/logo.svg" alt="">
                <div v-else class="userLogo" @click="$router.push({ name: 'profile' })">{{ !user.name?'U':user.name }}</div>
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
            <div class="item_subHeader">New Project</div>
            <div class="item_subHeader">Open Project</div>
        </div>
    </div>
    <Popaps/>
</template>


<script>
import { global, user } from '@/servis/globalValues.js'
export default{
    name: 'Header',
    async mounted(){
        this.getData()
    },
    data(){
        return {
            isAdmin:false,
            global:{},
            user:{},
            show_menu:false,
        }
    },
    methods:{
        getData(){
            this.global = global
            this.user = user
        },
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