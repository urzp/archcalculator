<template>
     <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="list">
                <div class="item">Email</div>
                <input type="text" @change="event=>chekEmail(event.target.value)"/>
                <div class="item">Password</div>
                <input type="password" />
                <div class="submit">
                    <Button heigth="35px" width="150px">Einreichen</Button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { validateEmail } from '@/servis/functions.js'
export default{
    name: 'Login',
    mounted(){
        EventBus.on('Menu:Login',()=>this.show=true )
    },
    data(){
        return {
            show:false,
        }
    },
    methods:{
        close(){
            this.show=false
        },
        chekEmail(email){
            console.log(email)
           console.log( validateEmail(email) )
        },
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

    .list{
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

    .submit{
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
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