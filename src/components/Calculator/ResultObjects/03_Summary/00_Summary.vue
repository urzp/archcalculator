<template>
    <Title_SubObject name="Zusammenfassung" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <TotalNet :value="total_net"/>
        <TotalTax :percent="1"/>
        <Total />
    </Content_PartObject>
    <TotalAdditionalServis :hours="total_hours" :value="total_value" :collapse = 'collapse' />    
</template>

<script>
import { Project, updateProject } from '@/servis/projectData.js'
export default{
    name: 'Summary',
    async mounted(){
        this.getProject()
    },
    data(){
        return{
            collapse:false,
            project:{},
            test:0,
            test2:{},
        }
    },
    computed:{
        total_AdditionalServices(){
            if(!this.test.total_AdditionalServices) return 0
            return this.test.total_AdditionalServices
        },
        total_ExtraCosts(){
            if(!this.project.project.total_ExtraCosts) return 0
            return this.project.project.total_ExtraCosts          
        },
        total_net(){
            let result = 0 
            if(!this.project||!this.project.objects) return result
            this.project.objects.forEach( item=>{ result+=Number(item.total_object) } )
            result = result + Number( this.test.total_AdditionalServices )  + Number( this.total_ExtraCosts )
            return result
        },
    },
    props:{
        loaded:Boolean,
        project_id: String,
    },
    methods:{
        getProject(){
           this.project = Project
           this.test = Project.project
           this.test2 = Project.project.total_AdditionalServices
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
    margin-top: 20px;
    background-color: #fff!important;
}
</style>