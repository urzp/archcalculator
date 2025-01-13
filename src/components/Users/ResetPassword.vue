<template>
    <div v-if="show" class="wrap_pupap">
       <div class="pupap">
           <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
           <div class="form">

                <template v-if="stepEmail">
                <div class="item">{{ text.Email }}</div>
                <input type="text" @change="event=>chekEmail(event.target.value)"/>
                <div v-if="err_email" class="err">{{ text.Invalid_email_address }}</div>
                <div v-if="notfind_email" class="err">{{ text.Not_found }}</div>
                </template>

                <template v-if="stepCode">
                <div class="item" >{{ Code_at_Email }}</div>
                <input type="password" @change="event=>chekCode(event.target.value)" />
                <div v-if="err_code" class="err">{{ text.Fill_feld }}</div>
                <div v-if="wrong_code" class="err">{{ text.Code_wrong }}</div>
                </template>

                <template v-if="stepPassword">
                <div class="item" >{{ text.New_password }}</div>
                <input type="password" @change="event=>chekPassword(event.target.value)" />
                <div v-if="err_password" class="err">{{ text.Fill_feld }}</div>
                </template>

               <div class="submit">
                   <div v-if="waightResponce"  class="loading">{{ text.loading }}</div>
                   <div v-if="notFind"  class="loading not_find">{{ text.Not_found }}</div>
                   <Button height="35px" width="125px" @click="submit()">{{ text.Submit }}</Button>
               </div>

               <div class="links">
                   <div class="link" @click="openRegistration()">{{ text.Registration }}</div>
                   <div class="gap">|</div>
                   <div class="link" @click="openLogin()">{{ text.Login }}</div>
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
import { text } from '@/servis/text.js'
export default{
   name: 'ResetPassword',
   mounted(){
       EventBus.on('Menu:ResetPassword',()=>this.show=true )
   },
   data(){
       return {
           show:false,
           err_email:false,
           notfind_email:false,
           err_code:false,
           wrong_code:false,
           err_password:false,
           email:'',
           code:'',
           password:'',
           waightResponce: false,
           notFind:false,
           stepEmail:true,
           stepCode:false,
           stepPassword:false,
           text:{
                Email:text.UserServis.Email,
                Invalid_email_address: text.UserServis.Invalid_email_address,
                Not_found: text.UserServis.Not_found,

                Code_at_Email: text.UserServis.Code_at_Email,
                Fill_feld: text.UserServis.Fill_feld,
                Code_wrong: text.UserServis.Code_wrong,

                New_password: text.UserServis.New_password,

                loading: text.UserServis.loading,
                Submit: text.UserServis.Submit,

                Registration: text.UserServis.Registration,
                Login: text.UserServis.Login,
           }
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
       chekCode(code=this.code){
           if(!code){this.err_code=true; return false}
           this.err_code=false
           this.code = code
           return true
       },
       chekPassword(password=this.password){
           if(!password){this.err_password=true; return false}
           this.err_password=false
           this.password = password
           return true
       },
       async submit(){
            let result 
           if( this.stepEmail ){ 
                if( !this.chekEmail() ) return false
                let data = { email: this.email }
                this.notfind_email = false
                result  = await apiData({typeData:'resetPassword', data })
                if(!result.success) { this.notfind_email = true; return false }
                this.stepEmail = false
                this.stepCode = true 
                return false
            }
            if(this.stepCode){
                if( !this.chekCode() ) return false
                this.stepCode = false 
                this.stepPassword = true
                return false               
            }
            if(this.stepPassword){
                this.wrong_code = false
                let data = { email: this.email, code: this.code,  password: this.password }
                result =  await apiData({typeData:'resetPassword', data })
                if(!result.success) {
                    this.wrong_code = true
                    this.stepCode = true 
                    this.stepPassword = false
                    return false 
                }
                this.stepPassword = false 
                this.stepEmail = true
                this.openLogin()
                return false               
            }
       },
       openRegistration(){
           this.close()
           EventBus.emit(`Menu:Registration`)
       },
       openLogin(){
        this.close()
        EventBus.emit(`Menu:Login`)
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