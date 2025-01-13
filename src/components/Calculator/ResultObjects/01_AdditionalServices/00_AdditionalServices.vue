<template>
    <Title_SubObject :name="text.Additional_services" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <ItemAdditionalServis 
        v-for="item in list"
        :key="item.id"
        :id="item.id"
        :title="item.title"
        :hours="item.hours"
        :price_hours="item.price_hours"
        @deleteItem="id=>deleteItem(id)"
        @updateItem = "data=>updateItem(data)"
        />
        <div class="buttton_wrap">
            <NewButton   @click="newItem()"/>
        </div>
    </Content_PartObject>
    <TotalAdditionalServis :hours="total_hours" :value="total_value" :collapse = 'collapse' />    
</template>

<script>
import { Project, updateProject } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'AdditionalServices',
    async mounted(){
        this.getProject()
    },
    data(){
        return{
            collapse:false,
            list:[],
            project:{},
            text:{
                Additional_services: text.Calc.Additional_services,
            }
        }
    },
    computed:{
        total_hours(){
            let result = 0 
            if(!this.list||!Array.isArray(this.list)) return result
            this.list.forEach(item=>result+= Number(item.hours))
            return result
        },
        total_value(){
            let result = 0 
            if(!this.list||!Array.isArray(this.list)) return result
            this.list.forEach(item=>result+= item.hours*item.price_hours)
            this.project.total_AdditionalServices = result
            return result
        }
    },
    methods:{
        getProject(){
            if(!Project.project.AdditionalServices) return Project.project.AdditionalServices = []
            this.list = Project.project.AdditionalServices
            this.project = Project.project
        },
        newItem(){
            let id = this.list.length + 1
            let item = {id, title:'', hours:0, price_hours:0}
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
            Project.project.AdditionalServices = this.list
            updateProject()
        }   

    }
}
</script>

<style scoped>
.buttton_wrap{
    position: absolute;
    margin-top: 20px;
    background-color: #fff!important;
}
</style>