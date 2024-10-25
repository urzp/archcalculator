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
                :equivalent="equivalent" 
                :usePoints="usePoints"
                @usePoint="usePoints=true"
                @total="value=>setEquivalent(value)"
                :points = project.requirementsPoints
            />
        </div>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
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
        async id_paragraph(value){
           if(!!value) await this.getData()
        },
    },
    emits:['selected'],
    methods:{
        async getData(){
            let data = { 
                table : 'feeTableHonorarZones',
                selector_name : 'id_paragraph',
                selector : this.id_paragraph,
            }
            let result = (await apiData({typeData:'read', data})).data
            result = result.map(item=>{ item.value = item.name; return item })
            this.data.list = result
            let zone_1 = result[1]
            this.data.id = zone_1.id
            this.data.value = zone_1.value
            this.getProjectData()
        },
        async getProjectData(){
            if(!this.object_id) return this.switchDefData()
            let result = (await apiData({typeData:'getProjectHonorar', data:{id:this.object_id}})).data[0]
            this.project = result
            let requirementsPoints = this.project.requirementsPoints
            if(!!requirementsPoints) this.project.requirementsPoints = JSON.parse(requirementsPoints)
            this.switchProjectData()
        },
        switchProjectData(){
            console.log('switch')
            let project = this.project
            if(!!project.honorarLevel_id){this.dataUpdate(project.honorarLevel_id)}
            if(!!project.usePoints){
                this.usePoints = true;
                this.collapse_detals = false
            } 
        },
        select(data){
            this.listPointsUse = 'list'
            data.id = data.id_item
            this.usePoints=false
            this.dataUpdate(data.id)
            this.$emit('selected', data)
        },
        dataUpdate(id = this.id_paragraph ){
            this.data.id = id
            let element = this.data.list.find(item=>item.id==id)
            if(!!element){ this.data.value = element.value }
        },
        setEquivalent(value){
            let level =  this.data.list.find(item=>item.maxPoint >= value)
            if(!level) return false
            this.dataUpdate(level.id)
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
