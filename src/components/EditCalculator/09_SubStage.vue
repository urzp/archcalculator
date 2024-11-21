<template>

    <ContextMenu :data ="contextMenu" @action="data=>actionContextMenu(data)"/>

    <div class="wrap" @contextmenu.stop="contectMenuShow($event)">
        <div class="list">
            <div class="item" v-for="item, index in list" :key="item.id">
                <div class="wrap_item">
                    <div class="part left-part" @contextmenu="contextMenu.index=index; contextMenu.colum='name'">
                        <div class="hover-panel">
                            <DeleteButton @click.stop="deleteElement(item.id)" width="29px" heigth="20px"/>
                        </div>
                        <div class="number">{{ toLetters(index + 1) }}</div>
                        <ToggleButton closed @switch_tg="value=>showSub(value, index)"/>
                        <ImputTextMLine width="970px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                    </div>
                    <div v-if="!!list.length"  class="part right-part" @contextmenu="contextMenu.index=index;  contextMenu.colum='percent'">
                        <InputText width="55px" :value="item.percent" @submit_event="value=>update(index, value, 'percent')"/>
                    </div>
                </div>
                <div class="subStage" v-show="subShowList[index]">
                    <SubStage_L1 :id_subStage="item.id"/>
                </div>
            </div>
        </div>
        <NewButton style="margin-top: 10px;" width="100px" height="24px" @click="newElement()"/>
    </div>

</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { toLetters } from '@/servis/functions'
import { contectMenuShow } from '@/servis/contextMenu.js'
import { getClipboard } from '@/servis/functions.js'
export default {
    name:'SubStage',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[],
            subShowList:[],
            toLetters: toLetters,
            table :'subStage',
            contextMenu:{
                positon:{x:50,y:200},
                title: 'Leistungsphasen Unterabschnitt',
                items:[
                    {id:1, label: 'Copy list', action: this.copySubStage},
                    {id:2, label: 'Paste list', action: this.pasteSubStage},
                    {id:3, label: 'Paste Сolumn', action: this.updateListData},
                ]
            },
        }
    },
    props:{
        id_stage:String,
    },
    watch:{
        id_stage(){
            this.getData()
        }
    },
    methods:{
        async getData(){
            let data = { 
                table : this.table,
                selector_name : 'id_stage',
                selector : this.id_stage,
            }
            let result = await apiData({typeData:'read', data})
            this.list = result.data
        },
        async newElement(){
            let data = {
                id_stage:this.id_stage, 
                number: this.list.length,
                name: '',
                percent: '',
            }
            let table = this.table
            await apiData({typeData:'new', data, table})
            this.getData()    
        },
        async update(index, value, val_name){
            let element = this.list[index] 
            element[val_name] = value
            let table = this.table
            await apiData({typeData:'update', data: element, table})
            this.getData()
        },
        async deleteElement(id){
            let table = this.table
            await apiData({typeData:'delete', data:id, table})
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
        copySubStage(){
            localStorage.setItem('copy_subStage_id', this.id_stage)
        },
        async pasteSubStage(){
            let id_stage_copy = localStorage.getItem('copy_subStage_id', this.id_stage)
            let id_stage_paste = this.id_stage
            await apiData({typeData:'copySubStage', data: {id_stage_copy, id_stage_paste}})
            this.getData()
        },
        async updateListData(){
            let typeData = 'number'
            if(this.contextMenu.colum=='name') typeData = "string"
            let data = await getClipboard(typeData)
            if (!data||data.length==0) return false 
            let table = 'subStage'
            let parent_name = 'id_stage'
            let parent_id = this.id_stage
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
        margin-top: 0px;
        margin-bottom: 30px;
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
        width: 15px;
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
        margin-top: 5px;
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