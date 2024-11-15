<template>
    <Title_SubObject name="Honorargrundlagen" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <HOAI_version_calc :prop_id="HOAI_version" @selected="data=>{ data.id = data.id; selectParagraph(data.id) }"/>
        <Paragraph_calc :paragraph_id="paragraph" @selected="data=>{ paragraph = data.id; updateProjectData() }"/>
        <HonorarZone_calc :id_paragraph="paragraph" :object_id="object_id" />
        <HonorarRate_calc :id_paragraph="paragraph" :object_id="object_id"/>
        <Finance_calc :id_paragraph="paragraph" :object_id="object_id" />
        <Honorar_calc :id_paragraph="paragraph" :object_id="object_id" />
        <PayExtra_calc :id_paragraph="paragraph" :object_id="object_id" />
    </Content_PartObject>
    <TotalBasis :object_id="object_id" :collapse = 'collapse' :paragraph="paragraph"/>    
</template>

<script>
import { getSameParagraph } from '@/servis/calcData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export default{
    name: 'Basis',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            collapse:false,
            HOAI_version:'',
            paragraph:'',
            data:{},
        }
    },
    props:{
        object_id: [String, Number],
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
            this.paragraph = getSameParagraph( HOAI_v, this.paragraph )
            if(!this.paragraph){
                this.paragraph = '';
                console.log('no any pargraph')
            }else{
                this.updateProjectData()
            }
        }  
    }
}
</script>

<style scoped>

</style>