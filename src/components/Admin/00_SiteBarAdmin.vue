<template>
    <div  class="wrap_sitebar" :class="{'open':config.open}">
        <ButtonSiteBar :open="config.open" @click=" config.open=!config.open "/>
        <div class="slide_bar">
            <div class="item_level_0 main_groupe">
                <div class="title" @click="selection('Users')"><Marker :level="1"/> {{ text.Users + ': '}}<div class="count"> {{ Users }} </div></div>
                <div class="title" @click="selection('Projects')"><Marker :level="1"/> {{ text.Projects + ': '}}<div class="count"> {{ Projects }} </div></div>
                <div class="title" @click="selection('HOAI')"><Marker :level="1"/> {{ text.HOAI_versions + ': '}} <div class="count"> {{ HOAI_versions }} </div></div>
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
            }, 
            HOAI_versions:'',
            Users:'',
            Projects:'',
            text:{
                HOAI_versions: text.adminSideBar.HOAI_versions,
                Users: text.adminSideBar.Users,
                Projects: text.adminSideBar.Projects,
                Setings: text.adminSideBar.Setings,
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
        },
        selection(value){
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
    background-color: #D9D9D9;
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