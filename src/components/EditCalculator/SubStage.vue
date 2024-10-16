<template>
    <ContextMenu :data ="contextMenu" @action="data=>actionContextMenu(data)"/>
    <div class="wrap" @contextmenu.stop="contectMenuShow($event)">
        <div class="list">
            <div class="item" v-for="item, index in list" :key="item.id">
                <div class="wrap_item">
                    <div class="part left-part">
                        <div class="hover-panel">
                            <DeleteButton @click.stop="deleteElement(item.id)" width="29px" heigth="20px"/>
                        </div>
                        <div class="number">{{ toLetters(index + 1) }}</div>
                        <ImputTextMLine width="1000px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                    </div>
                    <div v-if="!!list.length"  class="part right-part">
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
export default {
    name:'SubStage',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[],
            toLetters: toLetters,
            contextMenu:{
                positon:{x:50,y:200},
                title: 'Leistungsphasen Unterabschnitt',
                items:[
                    {id:1, label: 'Copy list', action: this.copySubStage},
                    {id:2, label: 'Paste list', action: this.pasteSubStage},
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
            let result = await apiData({typeData:'SubStage', id: this.id_stage})
            this.list = result.data
        },
        async newElement(){
            let data = {
                id_stage:this.id_stage, 
                number: this.list.length,
                name: '',
                percent: '',
            }
            await apiData({typeData:'newSubStage', data})
            this.getData()    
        },
        async update(index, value, val_name){
            let element = this.list[index] 
            element[val_name] = value
            await apiData({typeData:'updateSubStage', data: element})
            this.getData()
        },
        async deleteElement(id){
            await apiData({typeData:'deleteSubStages', data: id})
            this.getData()    
        },
        contectMenuShow(e){
            e.preventDefault();
            this.contextMenu.positon.x = e.pageX + 20
            this.contextMenu.positon.y = e.pageY - 20
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