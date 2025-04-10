<template>
    <div class="profile" v-if="!show_user_projects">
        <div class="title-profile">
            <LeftButton @click="$emit('close')"/>
            <div class="name" >{{ text.Profile }}</div>
        </div>
        <template v-if="loaded">
            <div class="main_panel">
                <div class="prof_part">
                    <div class="icon_hover_wrap">
                    <div v-if="!user.avatar" class="main_icon">{{ !user.name?'U':user.name[0] }}</div>
                    <div v-else  class="main_icon"><img :src="url_avatar" alt=""></div>
                    </div>
                    <div class="user-data">
                        <div class="name-user">{{ user.name }}</div>
                        <div class="email-user">{{ user.email }}</div>
                        <div class="email-user">{{ user.phone }}</div>
                    </div>
                    <div class="user-data" @click="show_user_projects=true">
                        <UserFeeld :title="'Projects:'" :value="user.projects" />
                        <UserFeeld :title="'Contracts:'" :value="user.contracts" />
                        <UserFeeld :title="'Bills:'" :value="user.bills" />
                    </div>
                </div>
            </div>
            <div class="user_data_panel">
                <UserFeeld :title="text.GlobalID" :value="user.GlobalID" width="600px"/> 
                <UserFeeld :title="text.departmentName" :value="user.departmentName" width="600px"/>
                <UserFeeld :title="text.postcode" :value="user.postcode" width="600px"/>
                <UserFeeld :title="text.address" :value="user.address" width="600px"/>
                <UserFeeld :title="text.сityName" :value="user.cityName" width="600px"/>
                <UserFeeld :title="text.countryID" :value="user.countryID" width="600px"/>
            </div>
            <div class="user_data_panel">
                <UserFeeld :title="text.IBAN" :value="user.IBAN" width="600px"/>
                <UserFeeld :title="text.BIC" :value="user.BIC" width="600px"/>
                <UserFeeld :title="text.Institut" :value="user.Institut" width="600px"/>
                <UserFeeld :title="text.USt_Id_Nr" :value="user.USt" width="600px"/>
            </div>
        </template>
        <div v-else class="load">{{ text.loading }}</div>
    </div>
    <AdminUserProjects :user_id="user_id" :user_name="user.name" v-if="show_user_projects"  @close="show_user_projects=false"/>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { global, user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'AdminProfileUser',
    async mounted(){
        this.getData()
    },
    data(){
        return{
            loaded: true,
            show_user_projects:false,
            user: {},
            oldPassword:'',
            newPassword:'',
            checkPassword:'',
            errNewPasswords:false,
            sendingPasswords:false,
            success_Passwords:false,
            fall_Passwords:false,
            text:{
                Profile: text.UserServis.Profile,
                name: text.UserServis.felds.name,
                email: text.UserServis.felds.email,
                phone: text.UserServis.felds.phone,

                old_password: text.UserServis.felds.old_password,
                new_password: text.UserServis.felds.new_password,
                conform_password: text.UserServis.felds.conform_password,

                GlobalID: text.UserServis.felds.GlobalID,
                departmentName: text.UserServis.felds.departmentName,
                postcode: text.UserServis.felds.postcode,
                address: text.UserServis.felds.address,
                сityName: text.UserServis.felds.сityName,
                countryID: text.UserServis.felds.countryID,
                IBAN:text.UserServis.felds.IBAN,
                BIC:text.UserServis.felds.BIC,
                Institut:text.UserServis.felds.Institut,
                USt_Id_Nr:text.UserServis.felds.USt_Id_Nr,

                loading: text.UserServis.loading,
                Success: text.UserServis.Successful,
                fall: text.UserServis.fall,
                Save: text.UserServis.Save,
            }
        }
    },
    computed:{
        url_avatar(){
            let url = this.user.avatar
            return url
        },
        enableSend(){
            return !!this.oldPassword&&!!this.newPassword&&!!this.checkPassword&&this.newPassword==this.checkPassword
        },
    },
    props:{
        user_id:{
            type:[String, Number],
            default: ''
        }
    },
    emits:['close'],
    methods:{
        async getData(){
            let data =  await apiData({typeData:'adminProfilUserData',  id:this.user_id })
            this.user = data.user
            console.log(this.user.avatar)
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
        display: flex;
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
        justify-content: center;
    }

    .prof_part{
        width: 65%;
        display: flex;
        justify-content: space-between;
        font-family: 'Raleway-Light';
        align-items: center;
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
        cursor: pointer;
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

    .user_edit_panel{
        display: flex;
        justify-content: space-between;
    }

    .user_data_edit{
        padding-left: 50px;
    }

    .user_data_panel{
        margin-top: 50px;
        padding-left: 50px;
    }

    .new_password{
        padding-right: 50px;     
    }

    .send_panel{
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .result_panel{
        width: 100%;
        display: flex;
        justify-content: center;
        font-family: 'Raleway-Light';
        font-size: 20px;
        color: #5A5A5A;
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