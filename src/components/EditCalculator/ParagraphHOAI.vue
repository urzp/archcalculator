<template>
    <div class="wrap">
        
        <div class="title">
            <NewButton  @click="newElement()" width="35px" heigth="30px"><template v-if="!(!!data&&!!data.id)">New Paragraph</template></NewButton>
            <DeleteButton v-if="!!data&&!!data.id" @click="deleteElement()"  width="35px" heigth="30px"/>
            <div class="paragraph-name" >{{ data.name }}</div>
            <div class="paragraph-title" >{{ data.title }}</div>
            <SelectEdit_List 
                right 
                :data='data' 
                @selected="data=>select(data.id_item)" 
                @newElement="newElement()" 
                @deleteElement = "item=>deleteElement(item.id)" 
                @moveElement = "data=>moveElement(data.id, data.derect)"
                />
        </div>
        <template v-if="!!data&&!!data.id">
        <div class="form_pargraph_data">
            <div class="row">
                <div class="label">Sequence #:</div>
                <InputText :value="data.sequence" @submit_event="value=>update(value, 'sequence')"/>
            </div>
            <div class="row">
                <div class="label">Paragraph:</div>
                <InputText :value="data.paragraph" @submit_event="value=>update(value, 'paragraph')"/>
            </div>
            <div class="row">
                <div class="label">Name:</div>
                <InputText :value="data.name" @submit_event="value=>update(value, 'name')"/>
            </div>
            <div class="row">
                <div class="label">Title:</div>
                <InputText :value="data.title" @submit_event="value=>update(value, 'title')"/>
            </div>
            <div class="row">
                <div class="label"><a :href="data.link_basis" target="_blank">Link:</a></div>
                <InputText :value="data.link_basis" @submit_event="value=>update(value, 'link_basis')" width="600px"/>
            </div>
            <div class="row">
                <div class="label"><a :href="data.link_basis" target="_blank">Link:</a></div>
                <InputText :value="data.link_fee" @submit_event="value=>update(value, 'link_fee')" width="600px"/>
            </div>
        </div>
        <FeeTable :id_paragraph="data.id"/>
        </template>
    </div>
    
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'ParagraphHOAI',
    mounted(){
        this.getData()
    },
    data(){
        return{
            data:{
                id:'',
                sequence:'',
                paragraph:'',
                name:'',
                title:'',
                link_basis:'',
                link_fee:'',
                list:[],
            },
            
        }
    },
    props:{
        id_HOAI:String
    },
    watch:{
        id_HOAI(){
            this.clearData()
            this.getData()
        }
    },
    methods:{
        async getData(){
            let result = await apiData({typeData:'Paragraphs', id_HOAI: this.id_HOAI})
            this.data.list = result.data
            if(!this.data.list[0]) return false
            let ferst = this.data.list[0].id
            if(!this.data.id) this.select(ferst)
        },
        select(id){
            let selected_el = this.data.list.find(el=>el.id==id)
            if(!selected_el) return false
            this.data.id = id
            for (var key in selected_el){
                this.data[key] = selected_el[key]
            }
        },
        async clearData(){
            for (var key in this.data){
                this.data[key]=""
            }     
        },
        async update(value, data_property){
            this.data[data_property] = value
            let data = {...this.data}
            delete data.list
            await apiData({typeData:'updateParagraph', data})
            this.getData()
        },
        async newElement(){
            let last, sequence = 1
            if(!!this.data.list.length){
                last = this.data.list.length - 1
                sequence = Number( this.data.list[last].sequence ) + 1
            }
            let data = {
                id_HOAI: this.id_HOAI,
                name:'New §',
                sequence,
            }
            await apiData({typeData:'newParagraph', data})
            await this.getData()
            last = this.data.list.length - 1
            last = this.data.list[last].id
            this.select(last)
        },
        async deleteElement(id=''){
            if (!id) id = this.data.id
            await apiData({typeData:'deleteParagraph', data: id})
            this.clearData()
            await this.getData()
        },
        async moveElement(id, derect){
            let element = this.data.list.find(el=>el.id == id)
            let sequence = Number( element.sequence )
            let nextSequence
            if (derect=='up') nextSequence = sequence - 1
            if (derect=='down') nextSequence = sequence + 1
            let nextElement = this.data.list.find(el=>el.sequence == nextSequence)
            if(!nextElement) return false
            element.sequence = nextSequence
            nextElement.sequence = sequence
            await apiData({typeData:'updateParagraph', data:element})
            await apiData({typeData:'updateParagraph', data:nextElement})
            await this.getData()
        }

    }

}
</script>
<style scoped>
    .wrap{
        margin-top: 30px;
    }
    .title, .row{
        display: flex;
        align-items: center;
        column-gap: 15px;
    }
    .title{
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .form_pargraph_data{
        margin-top: 20px;
    }

    .label{
        font-family: 'Raleway-Light';
        font-size: 18px;
    }
    .row{
        margin-bottom: 5px;
    }
</style>