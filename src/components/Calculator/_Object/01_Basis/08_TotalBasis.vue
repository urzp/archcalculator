<template>
    <div v-if="!!paragraph" class="total-part-obj" :class="{collapse:collapse}">
        <div class="wrap" :class="{line:!collapse}">
            <div class="title">{{ text.Summe }}</div>
            <div class="value-percent">{{ percent }} %</div>
            <Price :value = 'value'/>
        </div>
    </div>
</template>

<script>

import { Project } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'TotalBasis',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            percent:100,
            project:{},
            text:{
                Summe: text.Calc.Summe,
            }
        }
    },
    props:{
        object_id:[String,Number],
        collapse:Boolean,
        paragraph:[String,Number],
    },
    watch:{
        async id_paragraph(id){
            if(!id) return false
            await this.getProjectData()
        },
        value(){
            this.project.honorar_total = this.value
        }
    },
    computed:{
        honorar(){
            if(!this.project||!this.project.honorar_calc) return 0
            return Number(this.project.honorar_calc)
        },
        payExtra(){
            if(!this.project||!this.project.payExtra) return 0
            return Number(this.project.payExtra.value)
        },
        value(){
            return this.honorar + this.payExtra
        }
    },
    methods:{
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
        },
    }
}
</script>
    
<style scoped>
.total-part-obj{
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
    margin-right: 40px;
}

.total-part-obj .wrap{
    display: flex;
    justify-content: flex-end;
    column-gap: 15px;
    font-family: 'Raleway-Regular';
    font-size: 20px;
    color: var(--color-akcent);
}
.wrap.line{
    border-top: solid 1px var(--color-akcent);
}

.total-part-obj.collapse{
    margin-top: 0px;
}
</style>