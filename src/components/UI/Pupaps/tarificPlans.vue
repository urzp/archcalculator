<template>
    <div v-if="show" class="wrap_pupap tarificPlans" :class="{'scrollable':scrollable}">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="title">{{ text.title }}</div>
            <div class="cards">
                <TarifCard v-for="item in list" :key="item.id" :cardData="item"/>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
import { global } from '@/servis/globalValues.js'
import { text } from '@/servis/text.js'                    
export default{
    name: 'tarificPlans',
    mounted(){
        EventBus.on('MenuTarif:open',this.openPopap)
    },
    data(){
        return {
            show:false,
            scrollable: false,
            width:'1100px',
            height: '750px',
            typeProjects: '',
            text:{
                title: text.tarificPlans.title,
            },
            list:[
                {   
                    id:0,
                    title:'Frei',
                    price:{
                        value: 0,
                        curency: '€',
                    },
                    price_period: 'Pro Monat',
                    list_sevices:[
                        {   
                            id:0,
                            text:'1 Rechner für die Verwendung',
                            text_align: 'center',
                        }
                    ]
                },
                {   
                    id:1,
                    title:'Premium',
                    price:{
                        value: 10,
                        curency: '€',
                    },
                    price_period: 'Pro Monat',
                    list_sevices:[
                        {   
                            id:0,
                            text:'Recher',
                        }
                    ],
                    button:{
                        label:'Kaufen',
                        link:'https://billing.stripe.com/p/login/cNi5kEdjI5vxeF9aXN4ow00',
                    }
                },
            ]
        }
    },
    methods:{
        openPopap(){
            if(window.screen.height > 750) {
                document.documentElement.style.overflow = 'hidden'
                this.scrollable = false
            }else{
                window.scrollTo(0, 50);
                this.scrollable = true
            }

            //this.getData(type)
            this.show=true
        }, 
        close(){
            document.documentElement.style.overflow = 'auto'
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
        left: calc(100% / 2 - 1100px / 2);
        top: calc(100vh / 2 - 750px / 2); 
        width: 1100px;
        min-height: 750px;
        background-color: #fff;
        border: 2px solid #e2e2e2;
        border-radius: 10px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .closeBtn{
        position: absolute;
        right: 7px;
        top: 7px;
        cursor: pointer;
    }

    .title{
        width: 150px;
        font-family: 'Raleway-Light';
        font-size: 32px;
        color: #2F2F2F;
        margin: 50px auto;
    }

    .cards{
        display: flex;
        justify-content: center;
        column-gap: 50px;
        padding: 0 50px;
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