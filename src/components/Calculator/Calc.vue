<template>
    <div class="calculator">
        <div class="title-project">
            <!-- <div class="name" >{{ project_name }}</div> -->
             <input type="text"  class="name" :value="project_name" @change="event=>newProjectName(event.target.value)"/>
            <div class="date">{{ created }}</div>
        </div>
        <template v-if="loaded">
        <div  class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" />
        </div>
        <div class="panel" >
            <NewButton width="140px" @click="newObject()" >Object</NewButton>
            <CloseButton @click="deleteObject()"/>
        </div>
        <ResultCalc/>
        </template>
        <div v-else class="load">Loading . . . </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { LoadCalcData } from '@/servis/calcData.js'
import { lastElement, formatDate } from '@/servis/functions.js'
import { newPoject, LoadProjectData, updateProject, newProjectObject, deleteProjectObject} from '@/servis/projectData.js'
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
            project_name: '',
            loaded: false,
            ListObjects:[],
            project:{},
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
    computed:{
        created(){
            let result = ''
            if(!!this.project&&!!this.project.created) { result = formatDate(this.project.created)}
            return result
        }
    },
    methods:{
        async getCalcData(){
            this.loaded = false
            await LoadCalcData()
        },
        async getProject(){
            this.loaded = false
            let result
            if(!this.project_id) return false
            if(this.project_id == 'new') result = await newPoject() 
            if(this.project_id != 'new') result = await LoadProjectData(this.project_id) 
            if(this.project_id == 'local') result.project.id = 'local'
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