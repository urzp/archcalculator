<template>
    <div v-if="show" class="wrap_menu">
        <div class="menu_pupap">
            <div v-if="!global.login" class="list notlogin">
                <div class="item" @click="selectItem('Login')">{{ text.Login }}</div>
                <div class="item" @click="selectItem('Registration')">{{ text.Registration }}</div>
            </div>
            <div v-if="global.login" class="list login">
                <div v-if=" this.$route.path!='/'" class="item" @click="$router.push({ name: 'home' })">{{ text.Calculator }}</div>
                <div v-if=" this.$route.path!='/profile'" class="item" @click="$router.push({ name: 'profile' })">{{ text.Profile }}</div>
                <div  class="item" @click="openTarif()">{{ text.Tarif }}</div>
                <div v-if="global.admin" class="item" @click="$router.push({ name: 'law_edit_data' })">{{text.Edit_HOAI_version}}</div>
                <div v-if="global.admin" class="item" @click="$router.push({ name: 'admin' })">{{text.Admin_Panel}}</div>
                <div class="item" @click="logOut()">{{ text.Logout }}</div>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>
</template>

<script>

import { EventBus } from '@/servis/EventBus'
import { global } from '@/servis/globalValues.js'
import { logOut } from '@/components/Users/servis.js'
import { text } from '@/servis/text.js'
export default{
    name: 'Menu',
    async mounted(){
        this.getData()
    },
    data(){
        return {
            global:{},
            text:{
                Login: text.menu.Login,
                Registration: text.menu.Registration,
                Edit_HOAI_version: text.menu.Edit_HOAI_version,
                Admin_Panel: text.menu.Admin_Panel,
                Logout: text.menu.Logout,
                Calculator: text.menu.Calculator,
                Profile: text.menu.Profile,
                Tarif: text.menu.Tarif,
            }
        }
    },
    props:{
        show:Boolean,
    },
    emits:['close'],
    methods:{
        getData(){
            this.global = global
        },
        close(){
            this.$emit('close')
        },
        selectItem(name){
            this.close()
            EventBus.emit(`Menu:${name}`)
        },
        openTarif(){
            EventBus.emit('MenuTarif:open')
        },
        logOut(){
            logOut()
            this.close()
            this.$router
            .push({ name: 'home' })
            .then(() => { this.$router.go(0) })
        }
    },
}
</script>


<style scoped>
    .wrap_menu{
        position: relative;
        z-index: 50;
    }
    .menu_pupap{
        position: absolute;
        right: -5px;
        top: 10px;
        width: 130px;
        min-height: 30px;
        background-color: #fff;
        border: 2px solid #D9D9D9;
        border-radius: 8px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .list{
        margin: 15px 0;
        display: flex;
        flex-direction: column;
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 16px;
        width: max-content;
    }

    .item{
        cursor: pointer;
        padding: 0 14px;
        
    }

    .item:hover{
        background-color: var(--color-akcent);
        color: #fff;
    }

    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
        z-index: 10;
    }

</style>