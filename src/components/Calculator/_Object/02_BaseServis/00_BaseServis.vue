<template>
    <Title_SubObject name="Leistungen" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
            <Stage_calc 
                v-for="item, index in list" 
                :key="item.id" 
                :object_id = "object_id"
                :id = item.id
                :index = "index"
                :title="item.name"
                :percent_def = "Number(item.percent)" 
                :percent= "perсent(index)" 
                :honorar="honorar"
                :list="item.subStages"
                @updatePercent ="data=>newPercent(data)"
                >
            </Stage_calc>
    </Content_PartObject>
    <TotalBasisServis :percent="total_percent" :value="total_value" :collapse = 'collapse' />    
</template>

<script>
import { getStages }  from '@/servis/calcData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export default{
    name: 'BaseServis',
    async mounted(){

    },
    data(){
        return{
            collapse:false,
            list:[],
            project:{},
            paragraph:'',
        }
    },
    watch:{
        loaded(){
            this.getProjectData()
        },
        paragraph(){
            this.getProjectData()
        },
        project:{
            handler(new_val){
                this.paragraph = new_val.paragraph_id 
            },
            deep:true,
        }
    },
    computed:{
        honorar(){
            return this.project.honorar_total
        },
        total_percent(){
            let result = 0
            if(!this.list) return 0
            this.list.forEach(item=>{
                if(!!item.userPercent||item.userPercent===0){
                    result = result + item.userPercent
                }else{
                    result = result + Number(item.percent)
                }
            })
            return result
        },
        total_value(){
            let result = 0
            result = this.honorar * this.total_percent/100
            this.project.servis_total = result
            return result
        }
    },
    props:{
        loaded:Boolean,
        object_id: String,
    },
    methods:{
        async getData(){
           this.list = JSON.parse(JSON.stringify(getStages(this.paragraph))) 
        },
        async getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            this.paragraph = this.project.paragraph_id
            await this.getData()
            this.setValues()  
        },
        setValues(){
            if(!this.project.stages) this.project.stages = []
            if(!this.project.stages_L0) this.project.stages_L0 = []
            if(!this.project.stages_L1) this.project.stages_L1 = []
            let stages = this.project.stages
            
            this.list.forEach((item, index)=>{
                item.userPercent = ''
                if(!!stages[index]){ item.userPercent = stages[index] }
            })
        },
        perсent(index){
            if(this.list[index].userPercent===0) return 0
            return Number( !!this.list[index].userPercent?this.list[index].userPercent:this.list[index].percent )
        },
        newPercent(data){
            let element = this.list.find(item=>item.id==data.id)
            element.userPercent = data.value
            this.updateProject()
        },
        updateProject(){
            this.project.stages = []
            this.list.forEach(index=>{
                this.project.stages.push(index.userPercent)
            })
            updateProjectObject(this.object_id, this.project)
        }   

    }
}
</script>

<style scoped>

</style>