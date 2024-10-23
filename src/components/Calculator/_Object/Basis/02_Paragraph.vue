<template>
    <div v-if="!!prop_id" class="main_row">
        <div class="title">Planungsgegenstand</div>
        <div class="value">{{ data.value }}</div>
        <div  class="select-list" >
            <Select_List :data="data" stopEventBus @selected="(data)=>select(data)"/>
        </div>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
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
        prop_id:String,
    },
    watch:{
        async prop_id(value){
           if(!!value) await this.getData()
        },
    },
    emits:['selected'],
    methods:{
        async getData(){
            let result = await apiData({typeData:'getParagraph_and_list', id_pargraph: this.prop_id })
            let paragraph = result.data.paragraph
            this.data.id = paragraph.id
            this.data.value = `${paragraph.name} ${paragraph.title}`

            let paragraphs = result.data.paragraphs
            paragraphs = paragraphs.map(item=>{item.value=`${item.name} ${item.title}`; return item})
            this.data.list = paragraphs
        },
        select(data){
            data.id = data.id_item
            this.dataUpdate(data.id)
            this.$emit('selected', data)
        },
        dataUpdate(id = this.prop_id ){
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