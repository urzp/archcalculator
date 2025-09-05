<template>
    <div class="profile">
        <div class="title-profile">
            <div class="name" >{{ text.Profile }}</div>
            <div class="button_part screen_less_640">
                <CloseButton @click="deleteUser()" width="95px" height="70px"/>
            </div>
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
                        <div class="tariff_plan" @click="openTarif()">{{ text.ActiveTariff }}: {{ activeTariff }}</div>
                        <div class="email-user">{{ user.email }}</div>
                        <form class="avatar_form" ref="avatar">
                            <input ref="avatar_file" type="file" name="avatar" @change="sendAvatar()" accept=".pdf,.jpg,.svg">
                        </form>
                    </div>
                </div>
                <div class="button_part screen_more_640">
                    <CloseButton @click="deleteUser()" width="95px" height="70px"/>
                </div>
            </div>
            <div class="user_edit_panel">
                <div class="user_data_edit">
                    <EditUserFeeld :title="text.name" :userKey="'name'"/>
                    <EditUserFeeld :title="text.email" :userKey="'email'"/>
                    <EditUserFeeld :title="text.phone" :userKey="'phone'"/>
                </div>
                <div class="new_password">
                    <EditPassword :title="text.old_password" @newValue="value=>setOldPassword(value)"/>
                    <EditPassword :title="text.new_password" :errNewPasswords="errNewPasswords" @newValue="value=>setNewPassword(value)"/>
                    <EditPassword :title="text.conform_password" :errNewPasswords="errNewPasswords" @newValue="value=>checkNewPassword(value)"/>
                    <div class="send_panel">
                        <div class="result_panel">
                            <div v-if="sendingPasswords">{{ text.loading }}</div>
                            <div v-if="success_Passwords">{{ text.Success }}</div>
                            <div v-if="fall_Passwords">{{ text.fall }}</div>
                        </div>
                        <Button v-if="enableSend" width="150px" @click="sendPasswords()">{{ text.Save }}</Button>
                    </div>    
                </div>
            </div>
            <div class="user_data_panel">
                <EditUserFeeld :title="text.GlobalID" :userKey="'GlobalID'" width="600px"/>
                <EditUserFeeld :title="text.departmentName" :userKey="'departmentName'" width="600px"/>
                <EditUserFeeld :title="text.postcode" :userKey="'postcode'" width="600px"/>
                <EditUserFeeld :title="text.address" :userKey="'address'" width="600px"/>
                <EditUserFeeld :title="text.сityName" :userKey="'cityName'" width="600px"/>
                <EditUserFeeld :title="text.countryID" :userKey="'countryID'" width="600px"/>
            </div>
            <div class="user_data_panel">
                <EditUserFeeld :title="text.IBAN" :userKey="'IBAN'" width="600px"/>
                <EditUserFeeld :title="text.BIC" :userKey="'BIC'" width="600px"/>
                <EditUserFeeld :title="text.Institut" :userKey="'Institut'" width="600px"/>
                <EditUserFeeld :title="text.USt_Id_Nr" :userKey="'USt'" width="600px"/>
            </div>
        </template>
        <div v-else class="load">{{ text.loading }}</div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { global, user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
import { updatedProfile, logOut } from '@/components/Users/servis'
import { text } from '@/servis/text.js'
export default{
    name: 'Profile',
    async mounted(){
        this.getData()
    },
    data(){
        return{
            loaded: true,
            user: {},
            oldPassword:'',
            newPassword:'',
            checkPassword:'',
            errNewPasswords:false,
            sendingPasswords:false,
            success_Passwords:false,
            fall_Passwords:false,
            tariffs:[],
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
                ActiveTariff: text.activeTarifPlane.ActiveTariff,
            }
        }
    },
    computed:{
        url_avatar(){
            let url = `${global.base_url}/users/user_${this.user.id}/avatar/${this.user.avatar}`
            return url
        },
        enableSend(){
            return !!this.oldPassword&&!!this.newPassword&&!!this.checkPassword&&this.newPassword==this.checkPassword
        },
        activeTariff(){
            let result = ''
            if(!global.isTariffActive&&this.tariffs.length>0) result = this.tariffs[0].title
            if(global.isTariffActive&&this.tariffs.length>0) result = this.tariffs[1].title
            return result
        }
    },
    methods:{
        async getData(){
            this.user = user
            this.loading = true
            let result = (await apiData({typeData:'tariffs'})).data
            this.tariffs = result
            this.loading = false
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
        },
        openTarif(){
            EventBus.emit('MenuTarif:open')
        },
        async deleteUser(){
            let router = this.$router
            EventBus.emit('Popap:comfirm',{
                title: text.UserServis.The_account_will_be_permanently_deleted,
                action: async ()=>{
                        await deleteSubscription()
                        let result = await apiData({typeData:'deleteUser' }) 
                        if(result.success){
                            logOut()
                            router.push({ name: 'home' })
                        }
                    }
                }
            )
        },
        async deleteSubscription(){
            let subscriptionId = user.stripe_subscription_id
            apiData({typeData:'deleteSubscription', subscriptionId})
        },
        setOldPassword(value){
            this.oldPassword = value
            this.comfernPasswords()
        },
        setNewPassword(value){
            this.newPassword = value
            this.comfernPasswords()
        },
        checkNewPassword(value){
            this.checkPassword = value
            this.comfernPasswords()
        },
        comfernPasswords(){
            this.errNewPasswords = false
            if(!this.oldPassword||!this.newPassword||!this.checkPassword)  return false
            if(this.newPassword!=this.checkPassword){
                this.errNewPasswords = true
                return false
            }
            return true
        },
        async sendPasswords(){
            if(!this.enableSend) return false
            this.sendingPasswords = true
            this.success_Passwords = false
            this.fall_Passwords = false
            let data = {
                oldPassword: this.oldPassword,
                newPassword: this.newPassword,
            }
            let result = await apiData({typeData:'newPassword', data }) 
            this.sendingPasswords = false
            if(result.success){
                this.success_Passwords = true
            }else{
                this.fall_Passwords = true
            }
            setTimeout(()=>{
                this.success_Passwords = false
                this.fall_Passwords = false
            }, 10000)
        }
    }
}
</script>

<style scoped>
    .profile{
        min-height: 75vh;
        margin-bottom: 100px;
    }

    .screen_less_640{
        display: none;
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
        padding-right: 50px;
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

    .user-data .email-user,.user-data .tariff_plan{  
        margin-top: -10px; 
        font-size: 24px;
        color: #929292;
    }

    .user-data .tariff_plan{
        font-size: 18px;
        cursor: pointer;
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