<template>
    <div class="main_row" v-if="!!id_paragraph">
        <div class="title">Honorarsatz</div>
        <div class="value">{{ data.value }}</div>
        <div  v-if="data.id == 6" class="precent">
            <Percent input_type :value = "data.percent" @edit_value = "procent=>setProcent(procent)"/>
        </div>
        <div  class="select-list" >
            <Select_List :data="data" stopEventBus @selected="(data)=>select(data)"/>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Project, setUnSavedStatus } from '@/servis/projectData.js'
export  default{
    name: 'HonorarRate_calc',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            data:{
                id:'',
                value: '',
                percent:'',
                list:[
                    {id:1, value:'Basissatz', percent:0},
                    {id:2, value:'Viertelsatz', percent:25},
                    {id:3, value:'Mittelsatz', percent:50},
                    {id:4, value:'Dreiviertelsatz', percent:75},
                    {id:5, value:'Höchstsatz', percent:100},
                    {id:6, value:'Prozent eingeben', percent:0},
                ],
            },
            project:{},
        }
    },
    props:{
        id_paragraph:[String, Number],
        object_id:[String,Number],
    },
    emits:['selected'],
    methods:{
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            this.data.id = this.project.HonorarRate.id
            this.data.value = this.project.HonorarRate.value
            this.data.percent = this.project.HonorarRate.percent
        },
        select(data){
            data.id = data.id_item
            this.dataUpdate(data.id)
            this.$emit('selected', data)
            this.updateProjectData()
        },
        setProcent(procent){
            this.data.percent = procent
            this.updateProjectData()
        },
        dataUpdate(id){
            this.data.id = id
            let element = this.data.list.find(item=>item.id==id)
            if(!!element){ this.data.value = element.value; this.data.percent = element.percent }
        },
        updateProjectData(){
            if(!this.project.HonorarRate) this.project.HonorarRate = {}
            this.project.HonorarRate.id = this.data.id
            this.project.HonorarRate.value = this.data.value
            this.project.HonorarRate.percent = this.data.percent
            setUnSavedStatus()
            //updateProjectObject(this.object_id, this.project)
        },
        
    }
}

</script>

<style scoped>
    .main_row{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
    }   
    .title{
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .percent{
        margin: 0 10px;
        color:#7a7a7a;
    }
    .select-list{
        margin-left: 20px;
        margin-right: 10px;
    }
</style>