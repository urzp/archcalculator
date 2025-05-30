<template>
    <div v-if="show" class="wrap_pupap message">
       <div class="pupap">
           <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
           <div class="content">
            <div class="message">{{ message }}</div>
           </div>
       </div>
   </div>
</template>


<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'message',
    mounted(){
        EventBus.on('Menu:Message', (message)=>this.openPopap(message))
    },
    data(){
        return {
            show:false,
            message:'',
        }
    },
    methods:{
        openPopap(message){
            this.show=true
            this.message = message
            setTimeout(this.close, 5000)
        },
        close(){
            this.show=false
        },
    }

}
</script>

<style scoped>
    .wrap_pupap{
        position: relative;
        z-index: 50;
    }
    .pupap{
        position: fixed;
        /* left: calc(100% / 2 - 200px / 2); */
        top: 25px;
        min-height: 30px;
        min-width: 200px;
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

    .content{
        min-height: 70px;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .message{
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 20px;
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