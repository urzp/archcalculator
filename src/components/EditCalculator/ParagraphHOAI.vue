<template>
    <div v-if="!loading" class="wrap">
        
        <div class="title">
            <NewButton v-if="!(!!data&&!!data.id)"  @click="newElement()" width="210px" heigth="45px">New Paragraph</NewButton>
            <NewButton v-else  @click="newElement()" width="45px" heigth="30px"></NewButton>
            <DeleteButton v-if="!!data&&!!data.id" @click="deleteElement()"  width="35px" heigth="30px"/>
            <div class="paragraph-name" >{{ data.name }}</div>
            <div class="paragraph-title" >{{ data.title }}</div>
            <SelectEdit_List 
                :data='data' 
                @selected="data=>select(data.id_item)" 
                @newElement="newElement()" 
                @deleteElement = "item=>deleteElement(item.id)" 
                @moveElement = "data=>moveElemnt(data)"
            />
        </div>
        <template v-if="!!data&&!!data.id">
        <div class="form_pargraph_data">
            <!-- <div class="row">
                <div class="label">Sequence #:</div>
                <InputText :value="data.sequence" @submit_event="value=>update(value, 'sequence')"/>
            </div> -->
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
                <InputText :value="data.title" @submit_event="value=>update(value, 'title')" width="300px"/>
            </div>
            <div class="row">
                <div class="label"><a :href="data.link_basis" target="_blank">Link:</a></div>
                <InputText :value="data.link_basis" @submit_event="value=>update(value, 'link_basis')" width="600px"/>
            </div>
            <div class="row">
                <div class="label"><a :href="data.link_fee" target="_blank">Link:</a></div>
                <InputText :value="data.link_fee" @submit_event="value=>update(value, 'link_fee')" width="600px"/>
            </div>
        </div>
        <FeeTable :id_paragraph="data.id"/>
        <RequirementsPoints :id_paragraph="data.id"/>
        <HonorarZone :id_paragraph="data.id"/>
        <div class="form_pargraph_data">
            <div class="title">Anlage</div>
            <div class="row">
                <div class="label"><a :href="data.link_basic_services" target="_blank">Link:</a></div>
                <InputText :value="data.link_basic_services" @submit_event="value=>update(value, 'link_basic_services')" width="600px"/>
            </div>
            <div class="row">
                <div class="label"><a :href="data.link_special_services" target="_blank">Link:</a></div>
                <InputText :value="data.link_special_services" @submit_event="value=>update(value, 'link_special_services')" width="600px"/>
            </div>
        </div>
        <Stages :id_paragraph="data.id"/>
        </template>
    </div>
    <div v-else class="load">Loading . . . </div>
    
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
            loading:false,
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
            this.loading = true
            let result = await apiData({typeData:'Paragraphs', id_HOAI: this.id_HOAI})
            this.data.list = result.data
            this.loading = false
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
                name:'§ New',
                sequence,
            }
            await apiData({typeData:'newParagraph', data})
            await this.getData()
            last = this.data.list.length - 1
            last = this.data.list[last].id
            this.select(last)
        },
        async moveElemnt(data){
            let element = data[0]
            let nextElement = data[1]
            await apiData({typeData:'updateParagraph',  data: element })
            await apiData({typeData:'updateParagraph', data: nextElement })
            this.getData()
        },
        async deleteElement(id=''){
            if (!id) id = this.data.id
            await apiData({typeData:'deleteParagraph', data: id})
            this.clearData()
            await this.getData()
        }
    }

}
</script>
<style scoped>
    .wrap{
        margin-top: 30px;
    }
    .load{
        margin-top: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
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