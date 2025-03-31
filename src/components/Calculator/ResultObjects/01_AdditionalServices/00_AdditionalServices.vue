<template>
    <Title_SubObject :name="text.Additional_services" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <ItemAdditionalServis 
        v-for="item in list"
        :key="item.id"
        :id="item.id"
        :title="item.title"
        :rate="item.rate"
        :price_rate="item.price_rate"
        :type_rate="item.type_rate"
        @deleteItem="id=>deleteItem(id)"
        @updateItem = "data=>updateItem(data)"
        />
        <div class="buttton_wrap">
            <NewButton v-if="!isLocked"   @click="newItem()"/>
        </div>
    </Content_PartObject>
    <TotalAdditionalServis  :value="total_value" :collapse = 'collapse' />    
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
        total_value(){
            let result = 0 
            if(!this.list||!Array.isArray(this.list)) return result
            this.list.forEach(item=>result=result+Number(item.summ))
            this.project.total_AdditionalServices = result
            return result
        },
        isLocked(){
            if(!!Project&&!!Project.project&&Project.project.locked=='1') return true
            return false
        },
        total_objects(){
            let result = 0
            Project.objects.forEach(item=>{
                result = result + item.total_object
            })
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
            let item = {id, title:'', rate:0, price_rate:0, type_rate:'h'}
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