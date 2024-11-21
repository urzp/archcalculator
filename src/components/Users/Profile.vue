<template>
    <div class="profile">
        <div class="title-profile">
            <div class="name" >Profile</div>
        </div>
        <template v-if="loaded">
            <div class="main_panel">
                <div class="prof_part">
                    <div class="main_icon">U</div>
                    <div class="wrap_icon_panel">
                        <div class="icon_panel">
                            <NewButton :width="'45px'" :height="'35px'"/>
                        </div>
                    </div>
                    <div class="user-data">
                        <div class="name-user">Paul</div>
                        <div class="email-user">ermak80_pass@mail.ru</div>
                    </div>
                </div>
                <div class="button_part">
                    <CloseButton width="95px" height="70px"/>
                </div>
            </div>
        </template>
        <div v-else class="load">Loading . . . </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'Profile',
    async mounted(){
    },
    data(){
        return{
            loaded: true,
        }
    },
    props:{
        project_id:String,
    },
    computed:{
    },
    methods:{
        async getCalcData(){

        },
    }
}
</script>

<style scoped>
    .profile{
        min-height: 75vh;
        margin-bottom: 100px;
    }

    .title-profile{
        margin-top: 60px;
        text-align: center;
        margin-bottom: 100px;
    }
    .title-profile .name{
        font-family: 'Raleway-Light';
        font-size: 36px;
        text-align: center;
        width: 100%;
    }
    .main_panel{
        width: 100%;
        height: 130px;
        display: flex;

    }

    .prof_part{
        width: 50%;
        border-right: 1px solid #C0C0C0;
        display: flex;
        align-items: center;
        font-family: 'Raleway-Light';
    }

    .prof_part .main_icon{
        width: 130px;
        height: 130px;
        border-radius: 65px;
        background-color: #EFEFEF;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #5A5A5A;
        font-size: 64px;
    }

    .wrap_icon_panel{
        position: absolute;
    }

    .icon_panel{
        position: relative;
        padding: 4px;
        width: 110px;
        height: 45px;
        left: 90px;
        top: 59px;
        background-color: #fff;
        border: 1px solid #D9D9D9;
        border-radius: 8px;
        box-shadow: 4px 4px 8px #d4d4d4;
    }

    .user-data{
        margin-left: 50px;

    }

    .user-data .name-user{
        font-size: 36px;
        color:#5A5A5A;
    }

    .user-data .email-user{  
        margin-top: -10px; 
        font-size: 24px;
        color: #929292;
    }

    .button_part{
        margin: auto;
    }


    .load{
        margin-top: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
    }
</style>