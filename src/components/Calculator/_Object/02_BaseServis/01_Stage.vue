<template>

    <div class="item-Part-obj">
        <div  class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div  class="main_row" >
            <div class="title">{{ title }}</div>
            <div class="wrap-numbers">
                <div class="wrap-percents">
                    <Percent :class="'default_percent'" :value = "percent_def" />
                    <Percent :class="'input_percent'" input_type :value = "percent" @edit_value="value=>updatePercent(value)"/>
                </div>    
                <div class="price" ><Price :value ="value" /></div>
            </div>
        </div>
        <div v-show="!collapse_detals" class="detal-list">
            <div class="wrap">
                <Stage_calc_L0 
                    v-for="item, index in list"
                    :key="item.id"
                    :object_id = "object_id"
                    :id="item.id"
                    :title="item.name"
                    :indexL1 = "this.index"
                    :index = "index"
                    :percent_def = "Number(item.percent)" 
                    :percent= "perсent(index)" 
                    :honorar="honorar"
                    @updatePercent="data=>newPercent(data)"
                    :list="item.subStage_l1"
                >
                </Stage_calc_L0>
            </div>
        </div>
</div>
</template>

<script>
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'Stage_calc',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            collapse_detals:true,
            project:{},
            stages_L0:[],
        }
    },
    props:{
        object_id: String,
        id:String,
        index:Number, 
        title:String,
        honorar:[Number, String],
        percent:[Number, String],
        percent_def:[Number, String],
        list:Array,
    },
    emits:['updatePercent'],
    computed:{
        value(){
            return this.honorar * this.percent/100
        }
    },
    methods:{ 
        getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            if(!!this.project.stages_L0&&!!this.project.stages_L0[this.index]) this.stages_L0 = this.project.stages_L0[this.index]
            this.setValue()
        },
        setValue(){
            this.list.forEach((item, index)=>{
                item.userPercent = ''
                if(!!this.stages_L0[index]) item.userPercent = this.stages_L0[index]
            })
        },
        updatePercent(value){
            this.$emit('updatePercent', {value, id:this.id})
        },
        perсent(index){
            if(this.list[index].userPercent===0) return 0
            return Number(!!this.list[index].userPercent?this.list[index].userPercent:this.list[index].percent)
        },
        newPercent(data){
            let element = this.list.find(item=>item.id==data.id)
            element.userPercent = data.value
            this.conutTotal()
            this.updateProject()
        },
        conutTotal(){
            let result = 0
            this.list.forEach(item=>{
                if(!!item.userPercent||item.userPercent===0){
                    result = result + item.userPercent
                }else{
                    result = result + Number(item.percent)
                }
            })
            this.updatePercent(result)
        },
        updateProject(){
            this.project.stages_L0[this.index] = []
            this.list.forEach(index=>{
                this.project.stages_L0[this.index].push(index.userPercent)
            })
            updateProjectObject(this.object_id, this.project)
        } 
    }
}

</script>

<style scoped>
    .detal-list{
        display: flex;
        justify-content: space-between;
        background-color: #fff;
        margin-bottom: 15px;
        margin-left: 0px;
    } 

    .detal-list::before{
        position: relative;
        left: 28px;
        top: -15px;
        content: "";
        border-left: solid 1px #E4E4E4;
        box-shadow: 0px 30px 0px #000;
        margin-bottom: 25px;
    }

    .wrap{
        width: 100%;
        margin-top: 10px;
    }
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

    .wrap-numbers{
        width: 300px;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .wrap-percents{
        display: flex;
        column-gap: 45px;
        align-items: baseline;
    }
    .default_percent{
        width: 50px;
        justify-content: flex-end;
        color: #999;
    }
    .input_percent{
        width: 50px;
        justify-content: flex-end;       
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .price{
        color:#838383;
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