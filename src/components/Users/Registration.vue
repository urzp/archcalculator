<template>
    <div v-if="show" class="wrap_pupap">
       <div class="pupap">
           <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
           <div class="form">

               <div class="item">Email</div>
               <input type="text" @change="event=>chekEmail(event.target.value)"/>
               <div v-if="err_email" class="err">{{ err_email_msg }}</div>

               <div class="item" >Password</div>
               <input type="password" @change="event=>chekPassword_1(event.target.value)" />
               <div v-if="err_password" class="err">{{err_password_msg}}</div>

               <div class="item" >Passwort bestätigen</div>
               <input type="password" @change="event=>chekPassword_2(event.target.value)" />
               <div v-if="err_password_2" class="err">{{err_password_2_msg}}</div>

               <div class="submit">
                   <div v-if="waightResponce"  class="loading">Loading . . .</div>
                   <div v-if="notFind"  class="loading not_find">Kontaktieren Sie den Support</div>
                   <Button height="35px" width="125px" @click="submit()">Registrieren</Button>
               </div>

               <div class="links">
                    <div class="link" @click="openLogin()">Login</div>
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
   name: 'Registration',
   mounted(){
       EventBus.on('Menu:Registration',()=>this.show=true )
   },
   data(){
       return {
           show:false,
           err_email:false,
           err_email_msg:'',
           err_password:false,
           err_password_msg:'',
           err_password_2:false,
           err_password_2_msg:'',
           email:'',
           password:'',
           password_2:'',
           waightResponce: false,
           notFind:false,
       }
   },
   methods:{
       close(){
           this.show=false
       },
       async chekEmail(email=this.email){
           if( !validateEmail(email) ){this.err_email=true; this.err_email_msg = "Keine gültige E-Mail" ;return false} 
           let result = await apiData({typeData:'notHasEmail', email }) 
           if(!result.success){ this.err_email=true; this.err_email_msg = "E-Mail vergeben" ;return false }
           this.err_email=false
           this.email = email
           return true
       },
       chekPassword_1(password=this.password){
           if(!password||password.length<6){ this.err_password=true; this.err_password_msg = "mindestens 6 Zeichen"; return false }
           this.err_password=false
           this.password = password
           return true
       },
       chekPassword_2(password_2=this.password_2){
        if(!password_2||password_2.length<6){this.err_password_2=true; this.err_password_2_msg = "mindestens 6 Zeichen" ;return false}
           this.err_password_2=false
           this.password_2 = password_2
           return true
       },
       chekSamePassword(){
            if(!(this.password===this.password_2)){ 
                this.err_password = true; 
                this.err_password_2 =true; 
                this.err_password_msg = "nicht identisch"
                this.err_password_2_msg = "nicht identisch"
                return false 
            }
            return true
       },
       async submit(){
            if( !(this.chekEmail()&&this.chekPassword_1()&&this.chekPassword_2()) ) return false 
            if(!this.chekSamePassword()) return false 
            let data = { email:this.email, password:this.password}
            this.waightResponce = true
            let result = await apiData({typeData:'registration', data })
            this.waightResponce = false
            if(!result.success){ 
                this.notFind=true 
                setTimeout(()=>{this.notFind=false}, 10000)
                return false 
            }
            this.openLogin()
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
       align-items: flex-end;
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