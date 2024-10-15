<template>
    <ContextMenu :data ="contextMenu" @action="data=>actionContextMenu(data)"/>
    <ContextMenu :data ="contextMenuItem" @action="data=>actionContextMenuItem(data)"/>  
    <div class="wrap" @contextmenu.stop="contectMenuShow($event)">
        <div class="title">Leistungsphasen</div>
        <div class="header">
            <div class="part left-part">
                <div class="number">#</div>
                <div class="name">Name</div>
            </div>
            <div v-if="!!list.length" class="part left-right">
            <div class="value">Prozent %</div>
            </div>
        </div>
        <div class="list">
            <div class="item" v-for="item, index in list" :key="item.id" @contextmenu.stop="contectMenuItemShow($event,index)">
                <div class="wrap_item">
                    <div class="part left-part">
                        <div class="hover-panel">
                            <DeleteButton @click.stop="deleteElement(item.id)" width="35px" heigth="28px"/>
                        </div>
                        <div class="number">{{ index + 1 }}</div>
                        <ToggleButton closed @switch_tg="value=>showSub(value, index)"/>
                        <InputText width="800px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                    </div>
                    <div class="part right-part">
                        <InputText width="55px" :value="item.percent" @submit_event="value=>update(index, value, 'percent')"/>
                    </div>
                </div>
                <div class="subStage" v-show="subShowList[index]">
                    <SubStage :id_stage="item.id"/>
                </div>
            </div>
        </div>
        <NewButton style="margin-top: 10px;" width="160px" heigth="28px" @click="newElement()"/>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default {
    name:'Stages',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[],
            subShowList:[],
            contextMenu:{
                positon:{x:50,y:200},
                title: 'Leistungsphasen',
                items:[
                    {id:1, label: 'Copy', action: this.copyStage},
                    {id:2, label: 'Paste', action: this.pasteStage},
                ]
            },
            contextMenuItem:{
                positon:{x:50,y:200},
                title: 'Leistungsphasen Punkt',
                indexSelectItem:'',
                items:[
                    {id:1, label: 'Copy Punkt', action: this.copyItemStage},
                    {id:2, label: 'Paste Punkt', action: this.pasteItemStage},
                ]
            },
        }
    },
    props:{
        id_paragraph:String,
    },
    watch:{
        id_paragraph(){
            this.getData()
        }
    },
    methods:{
        async getData(){
            let result = await apiData({typeData:'Stages', id: this.id_paragraph})
            this.list = result.data
        },
        async newElement(){
            let data = {
                id_paragraph:this.id_paragraph, 
                number: this.list.length,
                name: '',
                percent: '',
            }
            await apiData({typeData:'newStage', data})
            this.getData()    
        },
        async update(index, value, val_name){
            let element = this.list[index] 
            element[val_name] = value
            await apiData({typeData:'updateStages', data: element})
            this.getData()
        },
        async deleteElement(id){
            await apiData({typeData:'deleteStages', data: id})
            this.getData()    
        },
        showSub(value, index){
            this.subShowList[index] = value
        },
        contectMenuShow(e){
            e.preventDefault();
            this.contextMenu.positon.x = e.pageX + 20
            this.contextMenu.positon.y = e.pageY - 20
        },
        contectMenuItemShow(e, index){
            this.contextMenuItem.indexSelectItem = index
            e.preventDefault();
            this.contextMenuItem.positon.x = e.pageX + 20
            this.contextMenuItem.positon.y = e.pageY - 20
        },
        actionContextMenu(index){
            this.contextMenu.items[index].action()
        },
        actionContextMenuItem(index){
            this.contextMenuItem.items[index].action()
        },
        copyStage(){
            localStorage.setItem('buffer_stage_id_paragraph', this.id_paragraph)
        },
        copyItemStage(){
            let id = this.list[this.contextMenuItem.indexSelectItem].id
            localStorage.setItem('buffer_id_stage', id)
        }
    }
}

</script>


<style scoped>
    .wrap{
        margin-top: 30px;
    }

    .title{
        font-family: 'Raleway-Light';
        font-size: 20px;
    }


    .header{
        margin-top: 20px;
        display: flex;
        column-gap: 15px;
        font-family: 'Raleway-Light' ;
        font-size: 18px;
        justify-content: space-between;
    }

    .wrap_item{
        display: flex;
        column-gap: 20px;
        align-items: center;
        justify-content: space-between;
    }

    .item{
        display: flex;
        flex-direction: column;
    }

    .subStage{
        margin-left: 50px;
    }

    .number{
        font-family: 'Raleway-Light' ;
        font-size: 18px;      
    }

    .part{
        display: flex;
        align-items: center;
        column-gap: 20px;
    }
    .right-part{
        column-gap: 20px;
    }

    .value{
        width: 105px;
    }

    /* hover button */

    .part{
        margin-left: -50px;
        padding-left: 50px;
    }

    .hover-panel{
        position: absolute;
        transform: translateX(-60px);
        display: flex;
        column-gap: 5px;
        visibility: hidden;
    }

    .part:hover .hover-panel{
        visibility: visible;
    }

</style>