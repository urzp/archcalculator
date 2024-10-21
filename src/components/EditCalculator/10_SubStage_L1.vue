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
                        <div class="number">{{ toLetters(index + 1)+toLetters(index + 1) }}</div>
                        <ImputTextMLine width="950px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                    </div>
                    <div v-if="!!list.length"  class="part right-part" @contextmenu="contextMenu.index=index;  contextMenu.colum='percent'">
                        <InputText width="55px" :value="item.percent" @submit_event="value=>update(index, value, 'percent')"/>
                    </div>
                </div>
            </div>
        </div>
        <NewButton style="margin-top: 10px;" width="100px" heigth="24px" @click="newElement()"/>
    </div>

</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { toLetters } from '@/servis/functions'
import { contectMenuShow } from '@/servis/contextMenu.js'
import { getClipboard } from '@/servis/functions.js'
export default {
    name:'SubStage_L1',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[],
            toLetters: toLetters,
            table :'subStage_l1',
            contextMenu:{
                positon:{x:50,y:200},
                title: 'Unterabschnitt Level 1',
                items:[
                    {id:1, label: 'Paste Сolumn', action: this.updateListData},
                ]
            },
        }
    },
    props:{
        id_subStage:String,
    },
    watch:{
        id_subStage(){
            this.getData()
        }
    },
    methods:{
        async getData(){
            let data = { 
                table : this.table,
                selector_name : 'id_subStage',
                selector : this.id_subStage,
            }
            let result = await apiData({typeData:'read', data})
            this.list = result.data
        },
        async newElement(){
            let data = {
                id_subStage:this.id_subStage, 
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
        contectMenuShow(e){
            contectMenuShow(e,this.contextMenu)
        },
        actionContextMenu(index){
            this.contextMenu.items[index].action()
        },
        copySubStage(){
            localStorage.setItem('copy_subStage_id', this.id_subStage)
        },
        async pasteSubStage(){
            let id_subStage_copy = localStorage.getItem('copy_subStage_id', this.id_subStage)
            let id_subStage_paste = this.id_subStage
            await apiData({typeData:'copySubStage', data: {id_subStage_copy, id_subStage_paste}})
            this.getData()
        },
        async updateListData(){
            let typeData = 'number'
            if(this.contextMenu.colum=='name') typeData = "string"
            let data = await getClipboard(typeData)
            if (!data||data.length==0) return false 
            let table = 'subStage_l1'
            let parent_name = 'id_subStage'
            let parent_id = this.id_subStage
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
        align-items: flex-start;
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