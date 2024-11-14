<template>
    <Title_SubObject name="Nebenkosten" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <ItemExtraCost
        v-for="item in list"
        :key="item.id"
        :id="item.id"
        :title="item.title"
        :rate="item.rate"
        :price_rate="item.price_rate"
        @deleteItem="id=>deleteItem(id)"
        @updateItem = "data=>updateItem(data)"
        />
        <div class="buttton_wrap">
            <NewButton   @click="newItem()"/>
        </div>
    </Content_PartObject>
    <TotalExtraCosts :value="total_value" :collapse = 'collapse' />    
</template>

<script>
import { Project, updateProject } from '@/servis/projectData.js'
export default{
    name: 'ExtraCosts',
    async mounted(){
        this.getProject()
    },
    data(){
        return{
            collapse:false,
            list:[],
        }
    },
    computed:{
        total_rate(){
            let result = 0 
            this.list.forEach(item=>result+= Number(item.rate))
            return result
        },
        total_value(){
            let result = 0 
            this.list.forEach(item=>result+= item.rate*item.price_rate)
            Project.project.total_ExtraCosts = result
            return result
        }
    },
    props:{
        loaded:Boolean,
        object_id: String,
    },
    methods:{

        getProject(){
            if(!Project.project.ExtraCosts) return Project.project.ExtraCosts = []
            this.list = Project.project.ExtraCosts
        },
        newItem(){
            let id = this.list.length + 1
            let item = {id, title:'', rate:0, price_rate:0}
            this.list.push(item)
            this.updateProject()
        },
        updateItem(data){
            let item=this.list.find(item=>item.id==data.id)
            item[data.name]=data.value
            this.updateProject()
        },
        deleteItem(id){
            let index=this.list.findIndex(item=>item.id==id)
            delete this.list.splice(index, 1);
            this.updateProject()
        },
        updateProject(){
            Project.project.ExtraCosts = this.list
            updateProject()        
        }   

    }
}
</script>

<style scoped>
.buttton_wrap{
    margin-top: 20px;
    background-color: #fff!important;
}
</style>