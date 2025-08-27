<template>
     <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="form">
                <form action="" autocomplete="on">
                <div class="item">{{ text.Email }}</div>
                <input type="text" @change="event=>chekEmail(event.target.value)" autocomplete="email" />
                <div v-if="err_email" class="err">{{ text.Email_wrong }}</div>
                <div class="item" >{{ text.Password }}</div>
                <input type="password" @change="event=>chekPassword(event.target.value)" @keyup.enter="submit()" autocomplete="on" />
                <div v-if="err_password" class="err">{{ text.Fill_feld }}</div>
                <div class="submit">
                    <div v-if="waightResponce"  class="loading">{{ text.loading }}</div>
                    <div v-if="notFind&&!waightResponce"  class="loading not_find">{{ text.Not_found }}</div>
                    <Button height="35px" width="125px" @click="submit()">{{ text.Submit }}</Button>
                </div>
                <div class="links">
                    <div v-if="false" class="link" @click="openRegistration()">{{ text.Registration }}</div>
                    <div v-if="true" class="gap">|</div>
                    <div class="link" @click="openReset()" >{{ text.Forgot_password }}</div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { validateEmail } from '@/servis/functions.js'
import { apiData } from '@/servis/apiData.js'
import { global } from '@/servis/globalValues.js'
import { logIn } from '@/components/Users/servis.js'
import { text } from '@/servis/text.js'
export default{
    name: 'Login',
    mounted(){
        EventBus.on('Menu:Login',(nextOpen)=>this.openPopap(nextOpen) )
    },
    data(){
        return {
            show:false,
            err_email:false,
            err_password:false,
            email:'',
            password:'',
            waightResponce: false,
            notFind:false,
            nextOpen:()=>{},
            text:{
                Email: text.UserServis.Email,
                Email_wrong: text.UserServis.Email_wrong,
                Password: text.UserServis.Password,
                Fill_feld: text.UserServis.Fill_feld,
                loading: text.UserServis.loading,
                Not_found: text.UserServis.Not_found,
                Submit: text.UserServis.Submit,
                Registration: text.UserServis.Registration,
                Forgot_password: text.UserServis.Forgot_password,
            }
        }
    },
    methods:{
        openPopap(nextOpen=()=>{}){
            this.nextOpen = nextOpen
            this.show=true
        },
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
            let result = await apiData({typeData:'login', data })
            this.waightResponce = false
            if(!result.success){ 
                this.notFind=true 
                setTimeout(()=>{this.notFind=false}, 10000)
                return false 
            }
            logIn(result.data)
            if(result.data) this.nextOpen()
            this.close()
            
        },
        openRegistration(){
            this.close()
            EventBus.emit(`Menu:Registration`)
        },
        openReset(){
            this.close()
            EventBus.emit('Menu:ResetPassword')
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
        color: var(--color-akcent); 
    }

    .loading{
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .not_find{
       color:var(--color-akcent); 
    }

    .submit{
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
        column-gap: 30px;
    }

    .links{
        margin-top: 10px;
        display: flex;
        -moz-column-gap: 5px;
        column-gap: 5px;
        font-size: 14px;
        color: #ababab;
        justify-content: flex-end;
    }

    .link{
        cursor:pointer;
    }

    .link:hover{
        color:var(--color-akcent); 
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