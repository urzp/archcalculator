<template>
    <div class="wrap_feeld">
        <div class="title">{{ title }}</div>
        <div class="input"><input type="text" :value="user[userKey]" @change="event=>editValue(event.target.value)" autocomplete="off"></div>
        <div v-if="error_input" class="error">{{ error_msg }}</div>
    </div>
</template>

<script>
import { user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
import { validateEmail, validatePhone } from '@/servis/functions'
import { text } from '@/servis/text.js'
export default{
    name: 'EditUserFeeld',
    mounted(){
        this.getData()
    },
    data(){
        return {
            error_input:false,
            error_msg: text.UserServis.error,
            user:{},
        }
    },
    props:{
        title:{
            type:String,
            default:'',
        },
        userKey:String,
        width:{
            type:String,
            default: '400px',
        }
    },
    methods:{
        getData(){
            this.user = user
        },
        async editValue(value){
            if(this.userKey=="email"&&!(await this.validEmail(value))){return false} 
            if(this.userKey=="phone"&&!(await this.validPhone(value))){ return false} 
            this.error_input = false
            let key = this.userKey
            let result = await apiData({typeData:'updateUser', data:{key, value} }) 
            if(result.success) this.user[this.userKey] = value
            
        },
        async validEmail(value){
            if(!validateEmail(value)){
                this.error_input = true;
                this.error_msg = text.UserServis.error_Email
                return false;
            }
            if(value!=this.user.email){
                let result = await apiData({typeData:'notHasEmail', email:value }) 
                if(!result.success){ 
                    this.error_input = true;
                    this.error_msg = text.UserServis.Email_used ;
                    return false 
                }
            }
            return true
        },
        async validPhone(value){
            if(!validatePhone(value)){
                if(!!value) this.error_input = true;
                this.error_msg = text.UserServis.error_phone
                return false
            }
            return  true
        }


    }

}

</script>


<style scoped>
.title{
    font-family: 'Raleway-Light';
    font-size: 20px;
    color: #929292;
}


input{
    width: v-bind(width);
    height: 45px;
    padding-left: 10px;
    padding-right: 10px;
    font-family: 'Raleway-Light';
    font-size: 20px;
    color: #5A5A5A;
    border-radius: 3px;
    background-color: #EFEFEF;
}

.wrap_feeld{
    margin-bottom: 5px;
}
.error{
    font-family: 'Raleway-Light';
    font-size: 18px;
    color: var(--color-akcent);   
}
</style>