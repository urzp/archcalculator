<template>
    <div class="calculator">
        <div class="title-project">
            <!-- <div class="name" >{{ project_name }}</div> -->
             <input type="text"  class="name" :value="project_name" @change="event=>newProjectName(event.target.value)"/>
            <div class="date">23.08.2024</div>
        </div>
        <template v-if="loaded">
        <div  class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" :project_id="project_id" :loaded="loaded"/>
        </div>
        <div class="panel" >
            <NewButton width="140px" @click="newObject()" >Object</NewButton>
            <CloseButton @click="deleteObject()"/>
        </div>
        <ResultCalc :project_id="project_id"/>
        </template>
        <div v-else class="load">Loading . . . </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { LoadCalcData } from '@/servis/calcData.js'
import { lastElement } from '@/servis/functions.js'
import { LoadProjectData, updateProject, newProjectObject, deleteProjectObject} from '@/servis/projectData.js'
export default{
    name: 'Calculator',
    async mounted(){
       await this.getCalcData()
       await this.getProject()
       EventBus.on('Project:newObject', this.getProject)
       EventBus.on('Project:deleteObject',  this.getProject)
    },
    data(){
        return{
            project_name: 'New Project',
            project_id: '1',
            loaded: false,
            ListObjects:[],
            project:{},
        }
    },
    methods:{
        async getCalcData(){
            this.loaded = false
            await LoadCalcData()
        },
        async getProject(){
            this.loaded = false
            let result = await LoadProjectData(this.project_id)
            this.project = result.project
            this.ListObjects = result.objects
            this.project_name = result.project.name
            this.loaded = true
        },
        newProjectName(value){
            this.project_name = value
            this.project.name = value
            updateProject()
        },
        newObject(){
            newProjectObject(this.project_id)
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
        text-align: center;
        width: 100%;
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
    .load{
        margin-top: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
    }
</style>