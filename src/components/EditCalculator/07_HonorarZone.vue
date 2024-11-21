<template>

    <ContextMenu :data ="contextMenu" @action="updateListData()"/>
    
    <div class="wrap">
        <div class="title">Honorarzone</div>
        <div class="header">
            <div class="number">#</div>
            <div class="name">Name</div>
            <div class="max">hohe</div>
        </div>
        <div class="list">
            <div class="item" v-for="item, index in list" :key="item.id" v-show="index>0">
                <div class="number">{{ index }}</div>
                <div class="name">{{ item.name }}</div>
                <div @contextmenu="contectMenuShow($event); contextMenu.index=index; contextMenu.colum='maxPoint'" >
                    <InputText width="50px" :value="item.maxPoint" @submit_event="value=>update(index, value, 'maxPoint')"/>
                </div>
            </div>
        </div>
        <div class="panel">
            <DeleteButton style="margin-top: 10px;" width="70px" heigth="28px" @click="deleteElement()"/>
            <NewButton style="margin-top: 10px;" width="70px" height="28px" @click="newElement()"/>
        </div>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'
import { contectMenuShow } from '@/servis/contextMenu.js'
import { getClipboard, lastElement } from '@/servis/functions.js'
export default{
    name:'HonorarZone',
    mounted(){
        this.getData()
        EventBus.on('reloadHonorarZone', this.getData)
    },
    data(){
        return{
            list:[],
            table :'feeTableHonorarZones',
            contextMenu:{
                colum:'',
                index:0,
                positon:{x:50,y:200},
                title:'Bewertungsmerkmale',
                items:[{id:1, label: 'Paste Сolumn'}]
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
            let data = { 
                table : this.table,
                selector_name : 'id_paragraph',
                selector : this.id_paragraph,
            }
            let result = await apiData({typeData:'read', data})
            this.list = result.data
        },
        async update(index, value, val_name){
            let element = this.list[index] 
            element[val_name] = value
            let table = this.table
            await apiData({typeData:'update', data: element, table})
            this.getData()
        },
        async newElement(){
            await apiData({typeData:'newHonorarZone', data: this.id_paragraph})
            EventBus.emit('reloadHonorarZone')
        },
        async deleteElement(){
            let table = this.table
            let id = lastElement(this.list).id
            await apiData({typeData:'delete', data:id, table})
            EventBus.emit('reloadHonorarZone')           
        },
        contectMenuShow(e){
            contectMenuShow(e,this.contextMenu)
        },
        async updateListData(){
            let typeData = 'number'
            if(this.contextMenu.colum=='name') typeData = "string"
            let data = await getClipboard(typeData)
            if (!data||data.length==0) return false 
            let table = 'feeTableHonorarZones'
            let parent_name = 'id_paragraph'
            let parent_id = this.id_paragraph
            let index_from = this.contextMenu.index 
            let colum = this.contextMenu.colum
            let stop_new = true
            await apiData({typeData:'updateList', data: {table, parent_name, parent_id, index_from, colum, data, stop_new}})
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
    }

    .item{
        display: flex;
        column-gap: 15px;
        align-items: center;
        font-family: 'Raleway-Light' ;
        font-size: 18px;    
    }

    .number{
        width: 20px;
    }
    .name{
        width: 170px;
    }

    .panel{
        display: flex;
        gap: 15px;
    }
</style>