<template>
    <div v-if="show" class="wrap_pupap">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="form">
                <div class="title">{{ title }}</div>
                <div class="panel">
                    <Button height="35px" @click.stop="comfirm()">Ja</Button>
                    <Button height="35px" @click.stop="close()">Nein</Button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'Comfirm',
    mounted(){
        EventBus.on('Popap:comfirm',(data)=>{this.openPopap(data)})
    },
    data(){
        return {
            title:'',
            show:false,
            action:()=>{},
        }
    },
    methods:{
        close(){
            this.title = ''
            this.action = ()=>{}
            this.show=false
        },
        openPopap(data){
            this.title = data.title
            this.show=true
            this.action = data.action
        }, 
        comfirm(){
            this.action()
            this.close()
        }
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
        left: calc(100% / 2 - 375px / 2);
        top: calc(100vh / 2 - 260px / 2);
        width: 385px;
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

    .title{
        margin: 20px 0px;
        text-align: right;
    }

    .panel{
        display: flex;
        justify-content: flex-end;
        column-gap: 15px;
        font-size: 18px;
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