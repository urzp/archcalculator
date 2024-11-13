<template>
    <div class="calculator">
        <div class="title-project">
            <div class="name">Project X</div>
            <div class="date">23.08.2024</div>
        </div>
        <div class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" :project_id="project" :loaded="loaded"/>
        </div>
        <div class="panel" >
            <NewButton width="140px" @click="newObject()" >Object</NewButton>
            <CloseButton @click="deleteObject()"/>
        </div>
        <TotalCalc/>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { LoadCalcData } from '@/servis/calcData.js'
import { lastElement } from '@/servis/functions.js'
import { LoadProjectData, newProjectObject, deleteProjectObject} from '@/servis/projectData.js'
export default{
    name: 'Calculator',
    async mounted(){
       await this.getCalcData()
       await this.getProject()
       EventBus.on('Project:newObject', this.getProject)
       EventBus.on('Project:deleteObject',  this.getProject)
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
        },
        newObject(){
            newProjectObject(this.project)
        },
        deleteObject(){
            let lastobject = lastElement(this.ListObjects)
            if(!lastobject) return false
            deleteProjectObject(lastobject.id)
        }
    }
}
</script>

<style scoped>
    .calculator{
        min-height: 75vh;
        margin-bottom: 100px;
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
    .panel{
        margin-top: 30px;
        margin-bottom: 30px;
        display: flex;
        justify-content: flex-end;
        column-gap: 15px;
        font-family: 'Raleway-Light';
        color: #929292;
        font-size: 20px;
    }
</style>