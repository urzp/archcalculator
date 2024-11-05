<template>
    <div class="wrap" :class="{active:usePoints}" @click="this.$emit('total', total); this.$emit('usePoint')">
        <div class="list" v-if="!!list.length">
            <div class="detal-item" v-for="item in list" :key="item.id">
                <input class="title" :placeholder="item.name" :value="item.user_title" @change="event => updateUserTitle(event.target.value, item.id)"/>
                <div class="value-wrap">
                    <div class="value">{{ item.value }}</div>
                    <div class="value-label">points</div>
                    <div class="bar_input">
                        <input class="slider" type="range" :min="item.minPoint" :max="item.maxPoint" :value="item.value" @change="event => updateValue(event.target.value, item.id)"> 
                    </div>
                </div>
            </div>
            <div class="total">
                <div class="total_points">
                    <div class="label">Total points: </div>
                    <div class="value">{{ total }}</div>
                </div>
                <div class="equivalent">
                    <div class="label">corresponds to fee zone: </div>
                    <div class="value">{{ equivalent }}</div>         
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'HonorarZoneDetal',
    mounted(){
        EventBus.on('updateProjectObject', this.getProjectData() )
    },
    data(){
        return{
            collapse:true,
            total:{},
            list:[],
            points:[],
            pointsName:[],
        }
    },
    emits:['total', 'usePoint'],
    props:{
        id_paragraph:String,
        object_id:String,
        equivalent:String,
        usePoints:Boolean,
    },
    watch:{
        id_paragraph(){
            this.getData()
        },
        points:{
            handler(){
                this.setVaulues()
            },
            deep:true
        }
    },
    computed:{
        total(){
            let result = this.list.reduce((sum, item) => sum + Number(item.value),0)
            return result
        },
    },
    methods:{
        async getData(){
            let result = (await apiData({typeData:'calc:requirementsPoints', id:this.id_paragraph})).data
            this.list = result
            this.setVaulues()
        },
        async getProjectData(){
            let project_object = Project.objects.find(item=>item.id==this.object_id)
            this.points = project_object.requirementsPoints
            this.pointsName = project_object.requirementsPointsNames
            this.getData()
        },
        async setVaulues(){
            if(!this.points||!this.points.length>0) return false
            let result =  this.list.map( (item, index) => {
                if(!!this.points[index]) item.value = this.points[index];
                if(!!this.pointsName[index]) item.name = this.pointsName[index];
                return item });
            this.list = result    
        },
        updateValue(value, id_item){
            let item = this.list.find(item=>item.id==id_item)
            item.value = value
            let saveList = this.list.map(item=>item.value)
            updateProjectObject(this.object_id, {requirementsPoints:saveList},false)
            this.getProjectData()
        },
        updateUserTitle(value, id_item){
            let item = this.list.find(item=>item.id==id_item)
            item.user_title = value
            let saveList = this.list.map(item=>item.user_title)
            saveList = saveList.filter(item=>!!item)
            updateProjectObject(this.object_id, {requirementsPointsNames:saveList},false)
            this.getProjectData()
        }
    }
}
</script>

<style scoped>
.wrap{
    display: flex;
    background-color: #fff;
    margin-left: 55px;
    margin-bottom: 15px;
    opacity: 0.5;
}
.wrap.active{
    opacity: 1.0;
}
.wrap::before{
    position: relative;
    left: -26px;
    top: -15px;
    content: "";
    border-left: solid 1px #E4E4E4;
    box-shadow: 0px 30px 0px #000;
    margin-bottom: 35px;
}
.list{
    width: 100%;
}
.detal-item{
    height: 30px;
    display: flex;
    justify-content: space-between;
    color: #8E8E8E;
    font-family:'Raleway-Light';
    font-size: 18px;
}

.value-wrap{
    display: flex;
    column-gap: 30px;
    font-size: 18px;
}

.title{
    color: #8E8E8E;
    width: 100%;
    font-family:'Raleway-Light';
    font-size: 18px;   
}

.slider {
    appearance: none; 
    width: 215px; 
    height: 10px; 
    background: #D9D9D9 ; 
    outline: none; 
    position: relative;
    overflow: hidden;

}

.slider::-webkit-slider-thumb {
    appearance: none; 
    width: 7px; 
    height: 10px; 
    border-radius: 2px; 
    border: solid 1px #7E7E7E;
    background: #FFFFFF;
    cursor: pointer; 
    box-shadow: -215px 0 0 215px #7E7E7E;
}

.total{
    display: flex;
    justify-content: flex-end;
    width: fit-content;
    column-gap: 30px;
    margin-left: auto;
    margin-top: 15px;
    padding-top: 5px;
    border-top: solid 1px #C7C7C7;
    color: #8E8E8E;
    font-family:'Raleway-Light';
    font-size: 18px;
}



.total_points, .equivalent{
    display: flex;
    column-gap: 15px;
}

</style>
