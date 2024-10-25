<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <HOAI_version_calc :prop_id="HOAI_version" @selected="data=>{data.id = data.id; selectParagraph(data.id)}"/>
        <Paragraph_calc :prop_id="paragraph" @selected="data=>{ paragraph = data.id; updateProjectData()}"/>
        <HonorarZone_calc :id_paragraph="paragraph" :object_id="object_id" />
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse' :data="data.Total"/>    
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'Basis',
    async mounted(){
      await this.getDefault()
    },
    data(){
        return{
            collapse:false,
            default:{
                HOAI_version:'',
                paragraph:'',
            },
            project:{
                HOAI_version:'',
                paragraph:'',
            },
            HOAI_version:'',
            paragraph:'',
            data:{},
        }
    },
    watch:{
        HOAI_version(){
            
        },
        object_id(){
            this.getProjectData()
        }
    },
    props:{
        object_id: String,
    },
    methods:{
        async getDefault(){
            let result = (await apiData({typeData:'getDafaultHOAI'})).data
            this.default.HOAI_version = result.id_HOAI
            this.default.paragraph = result.id
            this.getProjectData()
        },
        async getProjectData(){
            if(!this.object_id) return this.switchDefData()
            let result = (await apiData({typeData:'getProjectObject', data:{id:this.object_id}})).data[0]
            this.project = result
            this.switchProjectData()
        },
        switchDefData(){
            this.HOAI_version = this.default.HOAI_version
            this.paragraph = this.default.paragraph
        },
        switchProjectData(){
            this.HOAI_version = this.project.HOAI_version_id
            this.paragraph = this.project.paragraph_id       
        },
        updateProjectData(){
            this.project.HOAI_version_id = this.HOAI_version 
            this.project.paragraph_id = this.paragraph
            apiData({typeData:'updateProjectObject', data: this.project})
        },
        async selectParagraph(HOAI_v){
            let id_HOAI = HOAI_v
            let id_paragpaph = this.paragraph
            let result = (await apiData({typeData:'getSameParagraph', data: {id_paragpaph, id_HOAI}})).data
            if(!result.length){
                console.log('no any pargraph')
                this.paragraph = ''
            }else{
                this.paragraph = result
                updateProjectData()
            }
        }  
    }
}
</script>

<style scoped>

</style>