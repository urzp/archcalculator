<template>
    <div class="calculator">
        <div class="title-project">
            <div class="name">Project X</div>
            <div class="date">23.08.2024</div>
        </div>
        <div class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" :project_id="project" :loaded="loaded"/>
        </div>
        <TotalCalc/>
    </div>
</template>

<script>
import { LoadCalcData } from '@/servis/calcData.js'
import { LoadProjectData } from '@/servis/projectData.js'
export default{
    name: 'Calculator',
    async mounted(){
       await this.getCalcData()
       await this.getProject()
       this.loaded = true
    },
    data(){
        return{
            project: '1',
            loaded: false,
            ListObjects:[],
        }
    },
    methods:{
        async getCalcData(){
            await LoadCalcData()
        },
        async getProject(){
            let result = await LoadProjectData(this.project)
            this.ListObjects = result.objects
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