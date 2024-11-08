<template>
    <Title_SubObject name="Leistungen" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
            <Stage 
                v-for="item in list" 
                :key="item.id" 
                :id = item.id
                :title="item.name"
                :percent_def = "Number(item.percent)" 
                :percent= "Number(item.percent)" 
                :honorar="honorar"
                @updatePercent ="data=>newPercent(data)"
                >
            </Stage>
    </Content_PartObject>
    <TotalBasis :loaded="loaded" :object_id="object_id" :collapse = 'collapse' :paragraph="paragraph"/>    
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
            paragraph:'',
            list:[],
            project:{},
        }
    },
    watch:{
        loaded(){
            this.getProjectData()
        }
    },
    computed:{
        honorar(){
            return this.project.honorar_calc
        }
    },
    props:{
        loaded:Boolean,
        object_id: String,
    },
    methods:{
        async getData(){
           this.list = getStages(this.paragraph)
        },
        async getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            this.paragraph = this.project.paragraph_id
            this.getData()
        },
        newPercent(data){
            
        }

    }
}
</script>

<style scoped>

</style>