<template>
    <ContextMenu :data ="contextMenu" @action="updateListData()"/>
    <div class="wrap">
        <div class="title">Anrechenbare Kosten</div>
        <div class="header">
            <div class="part left-part">
                <div class="number">#</div>
                <div class="name">Name</div>
            </div>
        </div>
        <div class="list">
            <div class="item" v-for="item, index in list" :key="item.id" >
                <div class="part left-part">
                    <div class="hover-panel">
                        <DeleteButton @click.stop="deleteElement(item.id)" width="35px" heigth="28px"/>
                    </div>
                    <div class="number">{{ index + 1 }}</div>
                    <div @contextmenu="contectMenuShow($event); contextMenu.index=index; contextMenu.colum='name'" >
                        <InputText width="800px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                    </div>
                </div>
            </div>
        </div>
        <NewButton style="margin-top: 10px;" width="160px" height="28px" @click="newElement()"/>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { contectMenuShow } from '@/servis/contextMenu.js'
import { getClipboard } from '@/servis/functions.js'
export default{
    name:'AllowableCosts',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[],
            table:'allowableCosts',
            contextMenu:{
                colum:'',
                index:0,
                positon:{x:50,y:200},
                title:'Anrechenbare Kosten',
                items:[{id:1, label: 'Paste Сolumn'}]
            },
        }
    },
    props:{
        id_paragraph:String    
    },
    watch:{
        id_paragraph(){
            this.getData()
        }
    },
    methods:{
        async getData(){
            let data = { 
                table :this.table,
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
            let data = {
                id_paragraph:this.id_paragraph, 
                number: this.list.length,
                name: '',
            }
            let table = this.table
            await apiData({typeData:'new', data, table})
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
        async updateListData(){
            let typeData = 'number'
            if(this.contextMenu.colum=='name') typeData = "string"
            let data = await getClipboard(typeData)
            if (!data||data.length==0) return false 
            let table = 'allowableCosts'
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
        font-family: 'Raleway-Light' ;
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

    .item{
        display: flex;
        column-gap: 20px;
        align-items: center;
        justify-content: space-between;
    }

    .number{
        font-family: 'Raleway-Light' ;
        font-size: 18px;      
    }

    .part{
        display: flex;
        column-gap: 20px;
    }
    .right-part{
        column-gap: 20px;
    }

    .max{
        width: 64px;
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