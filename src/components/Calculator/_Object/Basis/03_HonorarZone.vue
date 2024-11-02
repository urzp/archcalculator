<template v-if="!!id_paragraph">
    <div class="item-Part-obj">
        <div  class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div class="main_row">
            <div class="title">Honorarzone</div>
            <div class="value">{{ data.value }}</div>
            <div  class="select-list" >
                <Select_List :data="data" stopEventBus @selected="(data)=>select(data)"/>
            </div>
        </div>
        <div v-show="!collapse_detals" class="detal-list">
            <FeeZoneDetal 
                :id_paragraph="id_paragraph" 
                :object_id = "object_id"
                :equivalent="equivalent" 
                :usePoints="usePoints"
                @usePoint="usePoints=true; updateProjectParagraphData()"
                @total="value=>setEquivalent(value)"
            />
        </div>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
import { lastElement } from '@/servis/functions.js'

export  default{
    name: 'HonorarZone_calc',
    async mounted(){
    },
    data(){
        return{
            collapse_detals:true,
            data:{
                id:'',
                number:'',
                value: '',
                usePoints:'',
                list:[],
            },
            project:{},
            equivalent:'',
        }
    },
    props:{
        id_paragraph:String,
        object_id: Object,
    },
    watch:{
        async id_paragraph(){
            await this.getData()
            this.getProjectData()
        }
    },
    emits:['selected'],
    methods:{
        async getData(){
            let result = ( await apiData({typeData:'calc:getHonorarZones', id:this.id_paragraph}) ).data
            this.data.list = result
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            if(!this.project.honorarLevel.usePoints){
                this.dataUpdate(this.project.honorarLevel_id, this.project.honorarLevel_number)
            } 
        },
        updateProjectParagraphData(){
            if(!this.project.honorarLevel) this.project.honorarLevel = {}
            this.project.honorarLevel = { ...this.data}
            delete this.project.honorarLevel.list
            updateProjectObject(this.object_id, this.project)
        },
        select(data){
            data.id = data.id_item
            this.usePoints=false
            this.project.honorarLevel_id = data.id
            this.project.honorarLevel_number = data.item.number
            this.dataUpdate(data.id, data.item.number)
            this.updateProjectParagraphData()
            this.$emit('selected', data)
        },
        dataUpdate(id, number){
            this.data.id = id
            let element = this.data.list.find(item=>item.number==number)
            if(!element){ element = lastElement(this.data.list) }
            this.data.value = element.value
        },
        setEquivalent(value){
            let level =  this.data.list.find(item=>item.maxPoint >= value)
            if(!level) return false
            if(this.usePoints) this.dataUpdate(level.id, level.number)
            this.equivalent = level.value
        }
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
