<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <div  class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div class="main_row" @mousedown="usePoints=false">
            <div class="title">Honorarzone</div>
            <div class="value">{{ data.value }}</div>
            <div class="select-list" >
                <Select_List :data="data" stopEventBus @selected="(data)=>select(data)"/>
            </div>
        </div>
        <div v-show="!collapse_detals" class="detal-list">
            <HonorarZoneDetal 
                :id_paragraph="id_paragraph" 
                :object_id = "object_id"
                :usePoints="usePoints"
                :levels="data.list"
                @usePoint=" usePoints=true "
                @equivalent="level=>setEquivalent(level)"
            />
        </div>
    </div>
</template>

<script>
import { getHonorarZones } from '@/servis/calcData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
import { lastElement } from '@/servis/functions.js'

export  default{
    name: 'HonorarZone_calc',
    async mounted(){
    },
    data(){
        return{
            collapse_detals:true,
            usePoints: '',
            data:{
                id:'',
                number:'',
                value: '',
                list:[],
            },
            project:{},
            equivalent:'',
        }
    },
    props:{
        loaded:Boolean,
        id_paragraph:String,
        object_id:String,
    },
    watch:{
        async loaded(){
            await this.getData()
            this.getProjectData(false)
        },
        async id_paragraph(id, old){
            if(!id||!old) return false
            await this.getData()
            this.getProjectData()
        },
        usePoints(){
            this.updateProjectParagraphData()
        }
    },
    emits:['selected'],
    methods:{
        async getData(){
            this.data.list =  await getHonorarZones( this.id_paragraph)
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            this.usePoints = this.project.honorarLevel.usePoints
            this.dataUpdate(this.project.honorarLevel.id, this.project.honorarLevel.number)
        },
        updateProjectParagraphData(){
            if(!this.project.honorarLevel) this.project.honorarLevel = {}
            this.project.honorarLevel = { ...this.data}
            this.project.honorarLevel.usePoints = this.usePoints
            delete this.project.honorarLevel.list
            updateProjectObject(this.object_id, this.project)
        },
        select(data){
            data.id = data.id_item
            this.usePoints=false
            this.data.number = data.item.number
            this.dataUpdate(data.id, data.item.number)
            this.updateProjectParagraphData()
            this.$emit('selected', data)
        },
        setEquivalent(level){
            if(!this.usePoints) return false
            this.dataUpdate(level.id, level.number)
        },
        dataUpdate(id, number){
            this.data.id = id
            this.data.number = number
            let element = this.data.list.find(item=>item.number==number)
            if(!element){ element = lastElement(this.data.list) }
            this.data.value = element.value
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
    .select-list{
        margin-left: 20px;
        margin-right: 10px;
    }

    .detals{
        position: relative;
    }
    .detals .icon{
        display: block;
        position: absolute;
        border-radius: 50%;
        height: 8px;
        width: 8px;
        background-color: #C0C0C0;
        content: " ";
        left: 25px;
        top: 13px;
        cursor: pointer;
    }

    .detal-list {
        background-color: #fff;
    }
    
</style>
