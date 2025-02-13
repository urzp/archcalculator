<template>
    <Title_SubObject :name="text.RestHonorar" @open_close="(val)=>{collapse=!val}"/>
    <Content_PartObject :collapse = 'collapse'>
        <RestTotalHonorar :value="project_total"/>
        <BillsPayments :total="project.previos_payments_total" :list="project.previos_payments"/>
        <CalcRestHonorar :value="project.payment_total" />
    </Content_PartObject>
</template>

<script>
import { Project, updateProject } from '@/servis/projectData.js'
export default{
    name:'RestHonorar',
    mounted(){
        this.getProject()
    },
    data(){
        return{
            collapse:false,
            project:{},
            text:{
                RestHonorar: text.Calc.RestHonorar,
            }
        }
    }, 
    watch:{
        project_total(){
            this.caunt_payment_total()
        }
    },
    computed:{
        project_total(){
            let result = 0
            if(!!this.project&&!!this.project.total) result = this.project.total
            return result
        }
    },
    methods:{
        getProject(){
           this.project = Project.project
        },
        caunt_payment_total(){
            let result = 0
            result = Number(this.project.total) - Number(this.project.previos_payments_total)
            this.project.payment_total = result
            return result
        }
    }
}
</script>

<style scoped>
    .total-calc{
        margin-top: 50px;
        margin-bottom: 30px;
        
    }

    .collapse{
        margin-bottom:0px;
    }

    .item{
        min-height: 100px;
    }
</style>