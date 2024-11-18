<template>
    <div v-if="show" class="wrap_menu">
        <div class="menu_pupap">
            <div class="list">
                <div class="item" @click="selectItem('Login')">Login</div>
                <div class="item">Registrierung</div>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'Menu',
    data(){
        return {

        }
    },
    props:{
        show:Boolean,
    },
    emits:['close'],
    methods:{
        close(){
            this.$emit('close')
        },
        selectItem(name){
            this.close()
            EventBus.emit(`Menu:${name}`)
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
        top: 25px;
        width: 175px;
        min-height: 30px;
        background-color: #fff;
        border: 2px solid #D9D9D9;
        border-radius: 10px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .list{
        margin: 15px 0;
        display: flex;
        flex-direction: column;
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 20px;
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