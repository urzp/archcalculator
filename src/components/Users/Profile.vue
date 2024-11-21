<template>
    <div class="profile">
        <div class="title-profile">
            <div class="name" >Profile</div>
        </div>
        <template v-if="loaded">
            <div class="main_panel">
                <div class="prof_part">
                    <div class="icon_hover_wrap">
                    <div class="main_icon">{{ !user.name?'U':user.name[0] }}</div>
                    <div class="wrap_icon_panel">
                        <div class="icon_panel">
                            <NewButton :width="'45px'" :height="'35px'"/>
                            <CloseButton width="45px" height="35px"/>
                        </div>
                    </div>
                    </div>
                    <div class="user-data">
                        <div class="name-user">{{ user.name }}</div>
                        <div class="email-user">{{ user.email }}</div>
                    </div>
                </div>
                <div class="button_part">
                    <CloseButton width="95px" height="70px"/>
                </div>
            </div>
            <div class="user_edit_panel">
                <div class="user_data_edit">
                    <EditUserFeeld title="name:" :userKey="'name'"/>
                    <EditUserFeeld title="email:" :userKey="'email'"/>
                    <EditUserFeeld title="phone:" :userKey="'phone'"/>
                </div>
                <div class="new_password">

                </div>
            </div>
        </template>
        <div v-else class="load">Loading . . . </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { user } from '@/servis/globalValues.js'
export default{
    name: 'Profile',
    async mounted(){
        this.getData()
    },
    data(){
        return{
            loaded: true,
            user: {},
        }
    },
    props:{
        project_id:String,
    },
    computed:{
    },
    methods:{
        async getData(){
            this.user = user
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
        margin-bottom: 80px;
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
        visibility:hidden;
    }

    .icon_hover_wrap:hover .icon_panel{
        visibility:visible;
    }

    .icon_panel:hover{
        visibility:visible;
    }

    .icon_panel{
        position: relative;
        padding: 4px;
        width: 105px;
        height: 45px;
        left: 84px;
        top: -35px;
        display: flex;
        column-gap: 4px;
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

    .user_data_edit{
        width: 50%;
        padding-left: 50px;

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