<template>
    <Title_SubObject :name="text.Summary" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <TotalNet :value="total_net"/>
        <TotalTax :percent="tax" :finance="total_net" @updateItem="value=>updateTax(value)"/>
        <Total :value="total" />
    </Content_PartObject>
    <TotalSummary  :value="total" :collapse = 'collapse' :billMode="billMode" />    
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Project, updateProject } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'Summary',
    async mounted(){
        this.getProject()
    },
    data(){
        return{
            collapse:false,
            project:{},
            tax:'0',
            text:{
                Summary: text.Calc.Summary,
            }
        }
    },
    watch:{
        total_net(){
            this.updateProject() 
        },
        total(){
            this.updateProject() 
        }
    },
    computed:{
        total_net(){
            let result = 0 
            if(!this.project||!this.project.objects) return result
            let objects = this.project.objects
            let project = this.project.project
            objects.forEach( item=>{ result+=Number(item.total_object) } )
            result = result + Number( project.total_AdditionalServices )  + Number( project.total_ExtraCosts )
            project.total_net = result
            return result
        },
        total(){
            let result = 0 
            if(!this.project||!this.project.objects) return result
            result = this.total_net + this.total_net * Number(this.tax)/100
            return result
        },
    },
    methods:{
        getProject(){
           this.project = Project
           if(!!this.project.project.tax) this.tax = this.project.project.tax 
        },
        updateProject(){
            let project = this.project.project
            project.total_net = this.total_net
            project.tax = this.tax
            project.total_tax = this.total_net * Number(this.tax)/100
            project.total = this.total
        },  
        updateTax(value){
            this.tax = value
            this.updateProject()
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