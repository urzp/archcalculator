<template>
    <div class="profile">
        <div class="title-profile">
            <div class="name" >Profile</div>
        </div>
        <template v-if="loaded">
            <div class="main_panel">
                <div class="prof_part">
                    <div class="icon_hover_wrap">
                    <div v-if="!user.avatar" class="main_icon">{{ !user.name?'U':user.name[0] }}</div>
                    <div v-else  class="main_icon"><img :src="url_avatar" alt=""></div>
                    <div class="wrap_icon_panel">
                        <div class="icon_panel">
                            <NewButton @click="selectAvatar()" :width="'45px'" :height="'35px'"/>
                            <CloseButton @click="deleteAvatar()" width="45px" height="35px"/>
                        </div>
                    </div>
                    </div>
                    <div class="user-data">
                        <div class="name-user">{{ user.name }}</div>
                        <div class="email-user">{{ user.email }}</div>
                        <form class="avatar_form" ref="avatar">
                            <input ref="avatar_file" type="file" name="avatar" @change="sendAvatar()" accept=".pdf,.jpg,.svg">
                        </form>
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
import { global, user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
import { updatedProfile } from '@/components/Users/servis'

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
    computed:{
        url_avatar(){
            let url = `${global.base_url}/users/user_${this.user.id}/avatar/${this.user.avatar}`
            return url
        }
    },
    props:{
        project_id:String,
    },
    methods:{
        async getData(){
            this.user = user
        },
        selectAvatar(){
            this.$refs.avatar_file.click()
        },
        async sendAvatar(){
            let data = new FormData(this.$refs.avatar)
            let result = await apiData({typeData:'avatar', data }) 
            this.$refs.avatar_file.value = ''
            updatedProfile()
        },
        async deleteAvatar(){
            this.$refs.avatar_file.value = ''
            let data = new FormData(this.$refs.avatar)
            let result = await apiData({typeData:'avatar', data }) 
            updatedProfile()
        }
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

    .main_icon img{
        width: 100%;
        height: 100%; 
        border-radius: 65px;
        object-fit: cover;
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

    .avatar_form{
        display: none;
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