<template>
    <div v-if="!!paragraph_id" class="main_row">
        <div class="title">Planungsgegenstand</div>
        <div class="value">{{ data.value }}</div>
        <div  class="select-list" >
            <Select_List :data="data" stopEventBus @selected="(data)=>select(data)"/>
        </div>
    </div>
</template>

<script>
import { getParagraph, getParagraphs } from '@/servis/calcData.js'
export  default{
    name: 'Paragraph_calc',
    async mounted(){
    },
    data(){
        return{
            data:{
                id:'',
                value: '',
                list:[],
            }
        }
    },
    props:{
        loaded:Boolean,
        paragraph_id:String,
    },
    watch:{
        async paragraph_id(id){
            if(!id) return false
            this.getData()
        },
    },
    emits:['selected'],
    methods:{
        async getData(){
            let paragraph = getParagraph(this.paragraph_id)
            if(!paragraph) return false
            this.data.id = paragraph.id
            this.data.value = `${paragraph.name} ${paragraph.title}`

            let paragraphs = getParagraphs(paragraph.id_HOAI)
            paragraphs = paragraphs.map(item=>{item.value=`${item.name} ${item.title}`; return item})
            this.data.list = paragraphs
        },
        select(data){
            data.id = data.id_item
            this.dataUpdate(data.id)
            this.$emit('selected', data)
        },
        dataUpdate(id = this.paragraph_id ){
            this.data.id = id
            let element = this.data.list.find(item=>item.id==id)
            if(!!element){ this.data.value = element.value }
        },
        
    }
}

</script>

<style scoped>
    .main_row{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
    }   
    .title{
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .select-list{
        margin-left: 20px;
        margin-right: 10px;
    }
</style>