<template>

    <ContextMenu :data ="contextMenu" @action="data=>actionContextMenu(data)"/>

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
            <div class="item" v-for="item, index in list" :key="item.id" >
                <div class="wrap_item">
                    <div class="part left-part" @contextmenu="contextMenu.index=index; contextMenu.colum='name'">
                        <div class="hover-panel">
                            <DeleteButton  width="35px" heigth="28px" @click.stop="deleteElement(item.id)"/>
                        </div>
                        <div class="number">{{ index + 1 }}</div>
                        <ToggleButton closed @switch_tg="value=>showSub(value, index)"/>
                        <InputText width="800px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                    </div>
                    <div class="part right-part" @contextmenu="contextMenu.index=index;  contextMenu.colum='percent'">
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
import { contectMenuShow } from '@/servis/contextMenu.js'
import { getClipboard } from '@/servis/functions.js'
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
                index:0,
                colum:'',
                positon:{x:50,y:200},
                title: 'Leistungsphasen',
                items:[
                    {id:1, label: 'Copy', action: this.copyStage},
                    {id:2, label: 'Paste', action: this.pasteStage},
                    {id:3, label: 'Paste mit Unterabsätzen', action: this.pasteStageDeep},
                    {id:4, label: 'Paste Сolumn', action: this.updateListData}
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
            contectMenuShow(e,this.contextMenu)
        },
        actionContextMenu(index){
            this.contextMenu.items[index].action()
        },
        copyStage(){
            localStorage.setItem('copy_stage_paragraph_id', this.id_paragraph)
        },
        pasteStageDeep(){ this.pasteStage(true) },
        async pasteStage(deep=''){
            let id_paragraph_stage_copy = localStorage.getItem('copy_stage_paragraph_id')
            let id_paragraph_stage_paste = this.id_paragraph
            await apiData({typeData:'copyStage', data: {id_paragraph_stage_copy, id_paragraph_stage_paste, deep}})
            this.getData()
        },
        async updateListData(){
            let typeData = 'number'
            if(this.contextMenu.colum=='name') typeData = "string"
            let data = await getClipboard(typeData)
            if (!data||data.length==0) return false 
            let table = 'Stages'
            let parent_name = 'id_paragraph'
            let parent_id = this.id_paragraph
            let index_from = this.contextMenu.index
            let colum = this.contextMenu.colum
            await apiData({typeData:'updateList', data: {table, parent_name, parent_id, index_from, colum, data}})
            this.getData() 
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