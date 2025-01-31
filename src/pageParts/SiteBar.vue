<template>
    <div class="wrap_sitebar" :class="{open}">
        <ButtonSiteBar :open="open" @click="open=!open"/>
        <div class="item_level_0 calcs">
            <div class="title" @click="openTogle.calcs=!openTogle.calcs"><Marker :level="0"/> {{ text.Calc }}</div>
            <div v-if="openTogle.calcs" class="content">
                <Item_level_1 button_type :title="text.NewCalc" />
                <Item_level_1 button_type :title="text.LastCalcs" />
                <Item_level_1 v-for="item in calcs" :key="item.id" :project_data="item" />
                <Item_level_1 button_type :title="text.OpenCalcs" />
            </div>
        </div>
        <div class="item_level_0 offers">
            <div class="title" @click="openTogle.offers=!openTogle.offers"><Marker :level="0"/> {{ text.Offer }}</div>
            <div v-if="openTogle.offers" class="content">
                <Item_level_1 button_type :title="text.NewOffer" />
                <Item_level_1 button_type :title="text.LastOffer" />
                <Item_level_1 v-for="item in calcs" :key="item.id" :project_data="item" />
                <Item_level_1 button_type :title="text.OpenOffer" />
            </div>            
        </div>
        <div class="item_level_0 projects">
            <div class="title" @click="openTogle.projects=!openTogle.projects"><Marker :level="0"/> {{ text.Project }}</div>
            <div v-if="openTogle.projects" class="content">
                <Item_level_1 button_type :title="text.NewProject" />
                <Item_level_1 button_type :title="text.OfferAsProject" />
                <Item_level_1 v-for="item in calcs" :key="item.id" :project_data="item" />
                <Item_level_1 button_type :title="text.OpenProject" />
            </div>              
        </div>
    </div>
</template>

<script>
import {text} from '@/servis/text'
export default{
    name: 'SiteBar',
    data(){
        return{
            open: true,
            openTogle:{
                calcs: true,
                offers: true,
                projects: true,
            },
            calcs:[
                {id:1, title:'Project X', date: '2025-01-31 13:23:44'},
                {id:2, title:'Project X', date: '2025-01-30 13:23:44'},
                {id:3, title:'Project X', date: '2025-01-23 13:23:44'},
            ],
            text:{
                Calc: text.sideBar.Calc,
                NewCalc: text.sideBar.NewCalc,
                LastCalcs: text.sideBar.LastCalcs,
                OpenCalcs: text.sideBar.OpenCalcs,

                Offer: text.sideBar.Offer,
                NewOffer: text.sideBar.NewOffer,
                LastOffer: text.sideBar.LastOffer,
                OpenOffer: text.sideBar.OpenOffer,    
                
                Project: text.sideBar.Project,
                NewProject: text.sideBar.NewProject,
                OfferAsProject: text.sideBar.OfferAsProject,
                OpenProject: text.sideBar.OpenProject,                    
            }
        }
    },
    methods:{

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

.item_level_1{
    display: flex;
    column-gap: 8px;    
    font-family: 'Raleway-Medium';
    font-size: 16px;
    margin-left: 17px;
    margin-bottom: 5px;
    cursor: pointer;
}


</style>