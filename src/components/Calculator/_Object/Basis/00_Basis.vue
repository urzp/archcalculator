<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <HOAI_version_calc :prop_id="HOAI_version" @selected="data=>{data.id = data.id; selectParagraph(data.id)}"/>
        <Paragraph_calc :paragraph_id="paragraph" @selected="data=>{ paragraph = data.id; updateProjectData()}"/>
        <HonorarZone_calc :id_paragraph="paragraph" :object_id="object_id" />
        <HonorarRate_calc :id_paragraph="paragraph" :object_id="object_id"/>
        <Finance_calc :id_paragraph="paragraph" :object_id="object_id" />
        <Honorar_calc :id_paragraph="paragraph" :object_id="object_id" />
        <PayExtra_calc :id_paragraph="paragraph" :object_id="object_id" />
    </PartObjectContent>
    <TotalBasis :object_id="object_id"/>    
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export default{
    name: 'Basis',
    async mounted(){
        EventBus.on('LoadedProject', this.getProjectData())
    },
    data(){
        return{
            collapse:false,
            HOAI_version:'',
            paragraph:'',
            data:{},
        }
    },
    watch:{
        object_id(){
            this.getProjectData()
        }
    },
    props:{
        object_id: String,
    },
    methods:{
        async getProjectData(){
            let project_object = Project.objects.find(item=>item.id==this.object_id)
            this.HOAI_version = project_object.HOAI_version_id
            this.paragraph = project_object.paragraph_id
        },
        updateProjectData(){
            let data = {
                HOAI_version_id: this.HOAI_version,
                paragraph_id: this.paragraph
            }
            updateProjectObject(this.object_id, data)

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
                this.updateProjectData()
            }
        }  
    }
}
</script>

<style scoped>

</style>