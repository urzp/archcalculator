<template>
    <div class="title-objects">
        <ToggleButton @switch_tg="(val)=>{this.$emit('switch_tg', val) }"/>
        <input  class="title" :value="nameTotalObject" @change="event => updateName(event.target.value)"/>
    </div>   
</template>

<script>

export default{
    name: 'Titile_Objects',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            nameTotalObject:'Total',
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