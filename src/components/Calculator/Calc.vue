<template>
    <div class="calculator">
        <template v-if="loaded">
        <CalcTitle></CalcTitle>
        <div  class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" />
        </div>
        <div class="panel">
            <NewButton width="200px" @click="newObject()" >{{ text.Honorarobjekt }}</NewButton>
            <CloseButton @click="deleteObject()"/>
        </div>
        <ResultCalc/>
        </template>
        <div v-else class="load">{{ text.Loading }}</div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { LoadCalcData } from '@/servis/calcData.js'
import { lastElement } from '@/servis/functions.js'
import { newPoject, LoadProjectData, saveAllProject, newProjectObject, deleteProjectObject} from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'Calculator',
    async mounted(){
       await this.getCalcData()
       await this.getProject()
       EventBus.on('MenuProjects:new', this.newProject)
       EventBus.on('Project:newObject', this.getProject)
       EventBus.on('Project:deleteObject',  this.getProject)
       EventBus.on('MenuProjects:reload', this.getProject)
    },
    data(){
        return{
            loaded: false,
            loaded_clac:false,
            ListObjects:[],
            project:{},
            text:{
                Honorarobjekt: text.Calc.Honorarobjekt,
                Loading: text.Calc.Loading,
            }
        }
    },
    props:{
        project_id:String,
    },
    watch:{
        project_id(){
            this.getProject()
        }
    },
    methods:{
        async getCalcData(){
            await LoadCalcData()
            this.loaded_clac = true
        },
        async getProject(){
            this.loaded = false
            if(!this.loaded_clac){  setTimeout(this.getProject, 300); return false} //if calc not loaded yet 
            EventBus.emit('Project:Loading')
            let result
            if(!this.project_id) return false
            if(this.project_id == 'new') result = await newPoject() 
            if(this.project_id != 'new') result = await LoadProjectData(this.project_id) 
            this.project = result
            this.ListObjects = this.project.objects
            this.loaded = true
        },
        async newProject(){
            this.loaded = false
            let result
            result = await newPoject() 
            this.project = result
            this.ListObjects = this.project.objects
            this.loaded = true
        },
        newObject(){
            newProjectObject(this.project_id, this.ListObjects.length)
        },
        deleteObject(){
            let lastobject = lastElement(this.ListObjects)
            if(!lastobject) return false
            deleteProjectObject(lastobject.id)
        },
    }
}
</script>

<style scoped>
    .calculator{
        min-height: 75vh;
        margin-bottom: 40px;
        border-bottom: 1px solid #999999;
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