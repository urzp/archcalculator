<template>
    <PartObjectTitle name="Basis" @open_close="(val)=>{collapse=!val}"/>
    <PartObjectContent :collapse = 'collapse'>
        <HOAI_version_calc :prop_id="HOAI_version" @selected="data=>{data.id = data.id; selectParagraph(data.id)}"/>
        <Paragraph_calc :prop_id="paragraph" @selected="data=>paragraph = data.id"/>
        <HonorarZone_calc  :prop_id="paragraph"/>
    </PartObjectContent>
    <PartObjectTotal :collapse = 'collapse' :data="data.Total"/>    
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'Basis',
    async mounted(){
      await this.getDefault()
      this.switchData()
    },
    data(){
        return{
            collapse:false,
            default:{
                HOAI_version:'',
                paragraph:'',
            },
            HOAI_version:'',
            paragraph:'',
        }
    },
    watch:{
        HOAI_version(){
            
        }
    },
    props:{
        data: Object,
    },
    methods:{
        async getDefault(){
            let result = (await apiData({typeData:'getDafaultHOAI'})).data
            this.default.HOAI_version = result.id_HOAI
            this.default.paragraph = result.id
        },
        switchData(){
            if(!this.data.HOAI_version) this.HOAI_version = this.default.HOAI_version
            if(!this.data.paragraph) this.paragraph = this.default.paragraph
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
            }
        }  
    }
}
</script>

<style scoped>

</style>