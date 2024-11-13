<template>
    <div class="title-object">
        <ToggleButton @switch_tg="(val)=>{this.$emit('switch_tg', val) }"/>
        <input  class="title" :value="nameObject" @change="event => updateName(event.target.value)"/>
        <CloseButton class="align-left" @click="deleteObject()"/>
    </div>   
</template>

<script>
import { Project, updateProjectObject } from '@/servis/projectData.js'
import {  deleteProjectObject } from '@/servis/projectData.js'
export default{
    name: 'Titile_Object',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            nameObject:'Object',
            project:{},
        }
    },
    props:{
        object_id:String,
    },
    emits: ['switch_tg'],
    methods:{
        async getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            this.nameObject = this.project.name
        },
        updateName(value){
            this.nameObject = value
            this.updateProject()
        },
        updateProject(){
            this.project.name = this.nameObject
            updateProjectObject(this.object_id, this.project)
        },  
        deleteObject(){
            deleteProjectObject(this.object_id)
        }
    }
}
</script>

<style scoped>
    .title-object{
        display: flex;
        align-items: center;
        column-gap: 15px;
        margin-left: 30px;
    }
    .title-object .name, input{
        width: 100%;
        font-family: 'Raleway-Light';
        font-size: 26px;
    }
    .align-left{
        margin-left: auto;
    }
</style>