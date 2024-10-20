<template>
    <ContextMenu :data ="contextMenu" @action="updateListData()"/>
    <div class="wrap">
        <div class="title">Bewertungsmerkmale</div>
        <div class="header">
            <div class="part left-part">
                <div class="number">#</div>
                <div class="name">Name</div>
            </div>
            <div v-if="!!list.length" class="part left-right">
            <div>Anforderungen:</div>
            <div class="min">geringe </div>
            <div class="max">hohe</div>
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
                <div class="part right-part">
                    <div @contextmenu="contectMenuShow($event); contextMenu.index=index; contextMenu.colum='minPoint'" >
                        <InputText width="55px" :value="item.minPoint" @submit_event="value=>update(index, value, 'minPoint')"/>
                    </div>
                    <div @contextmenu="contectMenuShow($event); contextMenu.index=index; contextMenu.colum='maxPoint'" >
                        <InputText width="40px" :value="item.maxPoint" @submit_event="value=>update(index, value, 'maxPoint')"/>
                    </div>
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
export default{
    name: 'RequirementsPoints',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[],
            table:'requirementsPoints',
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
            let data = {
                id_paragraph:this.id_paragraph, 
                number: this.list.length,
                name: '',
                minPoint: '',
                maxPoint: '',
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
            let table = 'requirementsPoints'
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
