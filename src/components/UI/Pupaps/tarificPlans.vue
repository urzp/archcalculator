<template>
    <div v-if="show" class="wrap_pupap tarificPlans" :class="{'scrollable':scrollable}">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="title_tariff">{{ text.title }}</div>
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
import { user } from '@/servis/globalValues.js'
import { text } from '@/servis/text.js'                    
export default{
    name: 'tarificPlans',
    mounted(){
        this.getData()
        console.log(user)
        EventBus.on('MenuTarif:open',this.openPopap)
    },
    data(){
        return {
            show:false,
            loading: false,
            scrollable: false,
            width:'1100px',
            height: '750px',
            typeProjects: '',
            text:{
                title: text.tarificPlans.title,
            },
            list:[
                // {   
                //     id:0,
                //     title:'Frei',
                //     price:{
                //         value: 0,
                //         curency: '€',
                //     },
                //     price_period: 'Pro Monat',
                //     list_sevices:[
                //         {   id:1,text:'Honorarrechner zur freien Verwendung'},
                //         {   id:2,text:'Honorarberechnung als PDF exportieren'},
                //         {   id:3,text:'Honorarberechnung per Link teilen'},
                //     ]
                // },
                // {   
                //     id:1,
                //     title:'Premium',
                //     price:{
                //         value: 25,
                //         curency: '€',
                //     },
                //     price_period: 'Pro Monat',
                //     list_sevices:[
                //         {   id:1,text:'Honorarrechner'},
                //         {   id:2,text:'Mehrere Honorarobjekte je Berechnung'},
                //         {   id:3,text:'Projekte sichern und öffnen'},
                //         {   id:4,text:'Angebote erstellen'},
                //         {   id:5,text:'Rechnungen erstellen'},
                //         {   id:6,text:'Abschlags- und Schlussrechnungen'},
                //         {   id:7,text:'Elektronische Rechnung im XRechnung Format (PDF mit integrierten Daten der elektronischen Rechnung'},
                //     ],
                //     button:{
                //         label:'Buchen',
                //         link:'https://billing.stripe.com/p/login/cNi5kEdjI5vxeF9aXN4ow00',
                //     }
                // },
            ]
        }
    },
    methods:{
        async getData(){
            this.loading = true
            let result = (await apiData({typeData:'tariffs'})).data
            this.list = result
            this.loading = false
        },
        openPopap(){
            if(window.screen.height > 900) {
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
        top: calc(100vh / 2 - 850px / 2); 
        width: 1100px;
        min-height: 850px;
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

    .title_tariff{
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

    @media (max-width: 1200px){
    .pupap{
            left: calc(100% / 2 - 850px / 2);
            top: calc(100vh / 2 - 850px / 2); 
            width: 850px;
            min-height: 850px;
        }
    }

    @media (max-width: 900px){
        .pupap{
            position: absolute;
            left: calc(100% / 2 - 650px / 2);
            top: calc(100vh / 2 - 850px / 2); 
            width: 650px;
            min-height: 850px;
            padding-bottom: 50px;
        }

        .cards{
            flex-direction: column;
            row-gap: 50px;
            align-items: center;
        }

    }

    @media (max-width: 680px){
        .pupap{
            position: absolute;
            left: calc(100% / 2 - 450px / 2);
            top: calc(100vh / 2 - 850px / 2); 
            width: 450px;
            min-height: 850px;
            padding-bottom: 50px;
        }
    }

     @media (max-width: 480px){

        .pupap{
            position: absolute;
            left: calc(100% / 2 - 420px / 2);
            top: calc(100vh / 2 - 850px / 2); 
            width: 420px;
            min-height: 850px;
            padding-bottom: 50px;
        }

        
     }
</style>