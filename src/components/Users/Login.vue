<template>
     <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="form">
                <div class="item">Email</div>
                <input type="text" @change="event=>chekEmail(event.target.value)"/>
                <div v-if="err_email" class="err">error Email</div>
                <div class="item" >Password</div>
                <input type="password" @change="event=>chekPassword(event.target.value)" />
                <div v-if="err_password" class="err">error</div>
                <div class="submit">
                    <div v-if="waightResponce"  class="loading">Loading . . .</div>
                    <Button heigth="35px" width="150px" @click="submit()">Einreichen</Button>
                </div>
            </div>
            
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { validateEmail } from '@/servis/functions.js'
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'Login',
    mounted(){
        EventBus.on('Menu:Login',()=>this.show=true )
    },
    data(){
        return {
            show:false,
            err_email:false,
            err_password:false,
            email:'',
            password:'',
            waightResponce: false,
        }
    },
    methods:{
        close(){
            this.show=false
        },
        chekEmail(email=this.email){
            if( !validateEmail(email) ){this.err_email=true; return false} 
            this.err_email=false
            this.email = email
            return true
        },
        chekPassword(password=this.password){
            if(!password){this.err_password=true; return false}
            this.err_password=false
            this.password = password
            return true
        },
        async submit(){
            if( !(this.chekEmail()&&this.chekPassword()) ) return false
            let data = {
                email: this.email,
                password: this.password,
            }
            this.waightResponce = true
            let result = (await apiData({typeData:'login', data })).data
        }
    },
}
</script>


<style scoped>
    .wrap_pupap{
        position: relative;
        z-index: 50;
    }
    .pupap{
        position: fixed;
        left: calc(100% / 2 - 375px / 2);
        top: calc(100vh / 2 - 260px / 2);
        width: 375px;
        min-height: 30px;
        background-color: #fff;
        border: 2px solid #D9D9D9;
        border-radius: 10px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .closeBtn{
        position: absolute;
        right: 7px;
        top: 7px;
        cursor: pointer;
    }

    .form{
        margin: 25px 35px;
        display: flex;
        flex-direction: column;
        row-gap: 5px;
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    input{
        width: 100%;
        height: 30px;
        background-color: #F5F5F5;
        color: #464646;
        font-size: 16px;
        padding: 0 10px;
    }

    .err{
        color: red;
    }

    .loading{
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .submit{
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
        column-gap: 30px;
    }


    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color:#0000003b;
        z-index: 10;
    }

</style>