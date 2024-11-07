<template>
    <div class="calculator">
        <div class="title-project">
            <div class="name">Project X</div>
            <div class="date">23.08.2024</div>
        </div>
        <div class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" :project_id="project"/>
        </div>
        <TotalCalc/>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { LoadCalcData } from '@/servis/calcData.js'
import { LoadProjectData } from '@/servis/projectData.js'
export default{
    name: 'Calculator',
    async mounted(){
       await this.getCalcData()
       await this.getProject()
    },
    data(){
        return{
            project: '1',
            ListObjects:[],
        }
    },
    methods:{
        async getCalcData(){
            await LoadCalcData()
            EventBus.emit('LoadedCalcData')
        },
        async getProject(){
            let result = await LoadProjectData(this.project)
            this.ListObjects = result.objects
            EventBus.emit('LoadedProject')
        }
    }
}
</script>

<style scoped>
    .calculator{
        min-height: 75vh;
    }

    .title-project{
        margin-top: 60px;
        text-align: center;
    }
    .title-project .name{
        font-family: 'Raleway-Light';
        font-size: 36px;
    }
    .title-project .date{
        font-family: 'Comfortaa-Regular';
        font-size: 16px;
        color:#999999
    }
</style>