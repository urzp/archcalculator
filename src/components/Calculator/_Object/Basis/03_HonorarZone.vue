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
                @usePoint="usePoints=true;updateProjectParagraphData()"
                @total="value=>setEquivalent(value)"
                :points = project.requirementsPoints
            />
        </div>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'

export  default{
    name: 'HonorarZone_calc',
    async mounted(){
    },
    data(){
        return{
            collapse_detals:true,
            usePoints:false,
            data:{
                id:'',
                value: '',
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
        async id_paragraph(value, value_old){
           if(!!value&&!value_old) {
                await this.getData()
                this.getProjectData()
           }
        },
    },
    emits:['selected'],
    methods:{
        async getData(){
            let result = ( await apiData({typeData:'calc:getHonorarZones', id:this.id_paragraph}) ).data
            this.data.list = result
            this.data.id = result[1].id
            this.data.value = result[1].value
        },
        async getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            this.switchProjectData()
        },
        updateProjectParagraphData(){
            console.log('update')
            updateProjectObject(this.object_id, this.project)
            //apiData({typeData:'updateProjectParagraphData', data:})
        },
        switchProjectData(){
            if(!!this.project.usePoints){
                this.usePoints = true;
            }else{
                this.dataUpdate(this.project.honorarLevel_id)
            } 
        },
        select(data){
            this.listPointsUse = 'list'
            data.id = data.id_item
            this.usePoints=false
            this.dataUpdate(data.id)
            this.updateProjectParagraphData()
            this.$emit('selected', data)
        },
        dataUpdate(id){
            this.data.id = id
            let element = this.data.list.find(item=>item.id==id)
            if(!!element){ this.data.value = element.value }
        },
        setEquivalent(value){
            let level =  this.data.list.find(item=>item.maxPoint >= value)
            if(!level) return false
            if(this.usePoints) this.dataUpdate(level.id)
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
