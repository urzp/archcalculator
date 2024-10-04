<template>
    <div class="wrap">
        <div class="label">Paragraph:</div>
        <div class="paragraph-name" >{{ data.name }}</div>
        <div class="paragraph-title" >{{ data.title }}</div>
        <SelectEdit_List  :data='data' @selected="data=>select(data.id_item)"/>
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
                name:'',
                title:'',
                list:{
                    
                }
            }
        }
    },
    methods:{
        async getData(){
            let result = await apiData({typeData:'Paragraphs', id_HOAI:'2'})
            this.data.list = result.data
            if(!this.id) this.select(1)
        },
        select(id){
            console.log(id)
            let selected_el = this.data.list.find(el=>el.id==id)
            if(!selected_el) return false
            this.data.id = id
            this.data.name = selected_el.name
            this.data.title = selected_el.title
        }
    }

}
</script>
<style scoped>
    .wrap{
        margin-top: 30px;
        min-height: 75px;
        display: flex;
        align-items: center;
        column-gap: 15px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .paragraph-name, .paragraph-title{
        font-family: 'Raleway-Medium';
    }
</style>