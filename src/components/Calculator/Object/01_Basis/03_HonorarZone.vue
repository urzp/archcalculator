<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <DetalMarker @click="collapse_detals=!collapse_detals" :collapse="collapse_detals"/>
        <div class="main_row" @mousedown="usePoints=false">
            <div class="title">{{ text.Honorarzone }}</div>
            <div class="value">{{ data.value }}</div>
            <div class="select-list" >
                <Select_List v-if="!isShowProject" :data="data" stopEventBus @selected="(data)=>select(data)"/>
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
import { Project, setUnSavedStatus } from '@/servis/projectData.js'
import { lastElement } from '@/servis/functions.js'
import { text } from '@/servis/text.js'
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
            text:{
                Honorarzone: text.Calc.Honorarzone
            }
        }
    },
    props:{
        id_paragraph:[String, Number],
        object_id:[String,Number],
    },
    watch:{
        async id_paragraph(){
            await this.getData()
            this.getProjectData()
        },
        usePoints(newValue, oldValue){
            if(oldValue==='') return false
            this.updateProjectParagraphData()
        }
    },
    computed:{
        isShowProject(){
            let result = false
            if(!!this.$route.query&&!!this.$route.query.project) result = true
            if(!!this.$route.query&&!!this.$route.query.bill) result = true
            return result
        }
    },
    emits:['selected'],
    methods:{
        async getData(){
            this.data.list =  await getHonorarZones(this.id_paragraph) 
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            if(!this.project) return false
            this.usePoints = this.project.honorarLevel.usePoints
            this.dataUpdate(this.project.honorarLevel.id, this.project.honorarLevel.number)
        },
        updateProjectParagraphData(){
            if(!this.project.honorarLevel) this.project.honorarLevel = {}
            this.project.honorarLevel = { ...this.data}
            this.project.honorarLevel.usePoints = this.usePoints
            delete this.project.honorarLevel.list
            setUnSavedStatus()
            //updateProjectObject(this.object_id, this.project)
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

    .detal-list {
        background-color: #fff;
    }
    
</style>
