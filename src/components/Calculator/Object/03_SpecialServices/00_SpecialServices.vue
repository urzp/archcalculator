<template>
    <Title_SubObject :name="text.Special_servis" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <ItemSpetialServis 
        v-for="item in list"
        :key="item.id"
        :id="item.id"
        :title="item.title"
        :percent="item.percent"
        :honorar="honorar"
        @deleteItem="id=>deleteItem(id)"
        @updateItem = "data=>updateItem(data)"
        />
        <div class="buttton_wrap">
            <NewButton v-if="!isLocked"  @click="newItem()"/>
        </div>
    </Content_PartObject>
    <TotalBasisServis :percent="total_percent" :value="total_value" :collapse = 'collapse' />    
</template>

<script>
import { Project, checkLock, setUnSavedStatus } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'SpecialServices',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            collapse:false,
            list:[],
            project:{},
            text:{
                Special_servis: text.Calc.Special_servis,
            }
        }
    },
    computed:{
        honorar(){
            return this.project.honorar_total
        },
        total_percent(){
            let result = 0
            this.list.forEach(item=>{ result = result + Number(item.percent)})
            return result
        },
        total_value(){
            let result = 0
            result = this.honorar * this.total_percent/100
            this.project.spetial_servis_total = result
            return result
        },
        isLocked(){
            if(!!Project&&!!Project.project&&Project.project.locked=='1') return true
            return false
        }
    },
    props:{
        object_id: [String,Number],
    },
    methods:{

        async getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            if(!this.project.specialServices) this.project.specialServices = []
            this.setValues()  
        },
        setValues(){
            this.list = this.project.specialServices
        },
        newItem(){
            let id = this.list.length + 1
            let item = {id, title:'', percent:0}
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
            setUnSavedStatus()
            //updateProjectObject(this.object_id, this.project)
        }   

    }
}
</script>

<style scoped>
.buttton_wrap{
    position:absolute;
    margin-top: 20px;
    background-color: #fff!important;
}
</style>