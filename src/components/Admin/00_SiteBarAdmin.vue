<template>
    <div  class="wrap_sitebar" :class="{'open':config.open}">
        <ButtonSiteBar :open="config.open" @click=" config.open=!config.open "/>
        <div class="slide_bar">
            <div class="item_level_0 main_groupe">
                <div class="title" @click="selection('Users')"><Marker :level="1"/> {{ text.Users + ': '}}<div class="count"> {{ Users }} </div></div>
                <div class="title" @click="selection('Projects')"><Marker :level="1"/> {{ text.Projects + ': '}}<div class="count"> {{ Projects }} </div></div>
                <div class="title" @click="selection('Bills')"><Marker :level="1"/> {{ text.Bills + ': '}}<div class="count"> {{ Bills }} </div></div>
                <div class="title" @click="selection('HOAI')"><Marker :level="1"/> {{ text.HOAI_versions + ': '}} <div class="count"> {{ HOAI_versions }} </div></div>
                <div class="title" @click="selection('Tariffs')"><Marker :level="1"/> {{ text.Tariffs + ': '}} <div class="count"> {{ Tariffs }} </div></div>
                
                <div class="title" @click="config.pages=!config.pages"><Marker :level="0"/>Pages</div>
                <div v-if="config.pages" class="content">
                    <Item_level_1 :title="'Impressum'" @click="selection('impressum')" />
                    <Item_level_1 :title="'Datenschutz'" @click="selection('datenschutz')"  />
                    <Item_level_1 :title="'Cookie Einstellungen'" @click="selection('cookie')"  />
                    <Item_level_1 :title="'Kontakt'" @click="selection('contacts')" />
                    <Item_level_1 :title="'Über HONORAR.online'" @click="selection('about')" />
                    <Item_level_1 :title="'Instructions'" @click="selection('instructions')" />
                </div>
                
                <div class="title" @click="selection('Setings')"><Marker :level="1"/> {{ text.Setings }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import {text} from '@/servis/text'
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'AdminSiteBar',
    mounted(){
        this.initConfig()
        this.initData()
        EventBus.on('AdminSiteBar:Update', this.initData)
    },
    data(){
        return{
            config:{
                open: true,
                main_groupe: true,
                pages:false,
            }, 
            HOAI_versions:'',
            Users:'',
            Projects:'',
            Bills:'',
            Tariffs:'',
            text:{
                HOAI_versions: text.adminSideBar.HOAI_versions,
                Users: text.adminSideBar.Users,
                Projects: text.adminSideBar.Projects,
                Bills: text.adminSideBar.Bills,
                Setings: text.adminSideBar.Setings,
                Tariffs: text.adminSideBar.Tariffs
            }           
        }
    },
    emits:['selected_item'],
    watch:{
        config:{
            handler(){
                localStorage.setItem('AdminSideBarConf', JSON.stringify(this.config))
            },
            deep: true,
        }
    },
    methods:{
        initConfig(){
            let data = JSON.parse(localStorage.getItem('AdminSideBarConf'))
            if(!!data) this.config = data
            if(!data) localStorage.setItem('AdminSideBarConf', JSON.stringify(this.config))
        },
        async initData(){
            let data = await apiData({typeData:'adminSiteBarData'})
            this.HOAI_versions = data.HOAI_versions
            this.Users = data.users
            this.Projects = data.projects
            this.Bills = data.bills
            this.Tariffs = data.tariffs
        },
        selection(value){
            EventBus.emit('Footer:selectMain')
            this.$emit('selected_item', value)
        }
    }
}
</script>

<style scoped>
.wrap_sitebar{
    width: 350px;
    height: 100vh;
    padding-top: 65px;
    padding-left: 25px;
    position: fixed;
    left: -355px;
    z-index: 100;
    background-color: #e0d6ad;
    box-shadow: 8px 0 8px rgba(0, 0, 0, 0.25);
    transition: transform 0.5s;
    color: #464646;
}

.slide_bar{
    overflow-y: auto;
    height: 100%;
}

.title{
    display: flex;
    column-gap: 5px;
    align-self: center;
    font-family: 'Raleway-Bold';
    font-size: 20px;
    cursor: pointer;
}

.open{
    transition: transform 0.5s;
    transform: translate(355px);
}

.item_level_0{
    margin-bottom: 15px;
}

.count{
    font-family: 'Raleway-Regular';
}

</style>