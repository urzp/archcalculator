<template>
    <div class="title-objects">
        <ToggleButton @switch_tg="(val)=>{this.$emit('switch_tg', val) }"/>
        <div  class="name" >Total: {{ nameTotalObject }}</div>
    </div>   
</template>

<script>
import { Project } from '@/servis/projectData';
export default{
    name: 'Titile_Objects',
    async mounted(){

    },
    data(){
        return{

        }
    },
    props:{
        object_id:String,
    },
    emits: ['switch_tg'],
    computed:{
        project(){
            return Project.project
        },
        nameTotalObject(){
            if(!Project.project) return ''
            return this.project.name
        }
    },
    methods:{
        async getProjectData(){

        },
        updateName(value){
            this.nameTotalObject = value
            this.updateProject()
        },
        updateProject(){
            this.project.name = this.nameObject
        },  
    }
}
</script>

<style scoped>
    .title-objects{
        display: flex;
        align-items: center;
        column-gap: 15px;
        margin-left: 30px;
    }
    .title-objects .name{
        width: 100%;
        font-family: 'Raleway-Light';
        font-size: 26px;
    }
    .align-left{
        margin-left: auto;
    }
</style>