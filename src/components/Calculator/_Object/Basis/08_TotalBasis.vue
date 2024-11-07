<template>
    <div class="total-part-obj" :class="{collapse:collapse}">
        <div class="wrap" :class="{line:!collapse}">
            <div class="title">Total</div>
            <div class="value-percent">{{ percent }} %</div>
            <Price :value = 'value'/>
        </div>
    </div>
</template>

<script>

import { Project } from '@/servis/projectData.js'
export default{
    name: 'TotalBasis',
    async mounted(){

    },
    data(){
        return{
            value:'',
            percent:100,
            project:{},
        }
    },
    props:{
        loaded:Boolean,
        object_id:String,
        collapse:Boolean,
    },
    watch:{
        loaded(){
            this.getProjectData()
        },
        async id_paragraph(){
            await this.getProjectData()
        },
        project:{
            handler(){
                this.calc()
            },
            deep:true,
        },
    },
    methods:{
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            this.calc()
        },
        calc(){
            let honorar = this.project.honorar_calc
            let payExtra = this.project.payExtra
            this.value = Number( honorar ) + Number( payExtra.value )
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