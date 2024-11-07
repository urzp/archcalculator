<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <HOAI_version_calc :loaded="loaded" :prop_id="HOAI_version" @selected="data=>{ data.id = data.id; selectParagraph(data.id) }"/>
        <Paragraph_calc :loaded="loaded" :paragraph_id="paragraph" @selected="data=>{ paragraph = data.id; updateProjectData() }"/>
        <HonorarZone_calc :loaded="loaded" :id_paragraph="paragraph" :object_id="object_id" />
        <HonorarRate_calc :loaded="loaded" :id_paragraph="paragraph" :object_id="object_id"/>
        <Finance_calc :loaded="loaded" :id_paragraph="paragraph" :object_id="object_id" />
        <Honorar_calc :loaded="loaded" :id_paragraph="paragraph" :object_id="object_id" />
        <PayExtra_calc :loaded="loaded" :id_paragraph="paragraph" :object_id="object_id" />
    </PartObjectContent>
    <TotalBasis :loaded="loaded" :object_id="object_id" :collapse = 'collapse' :paragraph="paragraph"/>    
</template>

<script>
import { getSameParagraph } from '@/servis/calcData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export default{
    name: 'Basis',
    async mounted(){

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
        loaded(){
            this.getProjectData()
        }
    },
    props:{
        loaded:Boolean,
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