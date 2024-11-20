<template>
        <div class="item-Part-obj" :class="{gap_left:list.length>0}">
            <div v-if="list.length>0" class="detals" @click="collapse_detals=!collapse_detals">
                <div class="icon"></div>
            </div>
            <div  class="main_row" >
                <div class="title">{{ title }}</div>
                <div class="wrap-numbers">
                    <div class="wrap-percents">
                        <Percent :class="'default_percent'" :value = "percent_def" font_size_value="16px" font_size_sumbol="14px" />
                        <Percent :class="'input_percent'" input_type :value = "percent" @edit_value="value=>updatePercent(value)" font_size_value="16px" font_size_sumbol="14px"/>
                    </div>    
                    <div class="price" ><Price :value ="value" font_size_unit="16px" font_size_cent="14px" /></div>
                </div>
            </div>
            <div v-show="!collapse_detals" class="detal-list">
                <div class="wrap">
                <Stage_calc_L1 
                    v-for="item, index in list"
                    :key="item.id"
                    :id="item.id"
                    :title="item.name"
                    :percent_def = "Number(item.percent)" 
                    :percent= "perсent(index)" 
                    :honorar="honorar"
                    @updatePercent="data=>newPercent(data)"
                >
                </Stage_calc_L1>
            </div>                
            </div>
        </div>
</template>

<script>
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'Stage_calc_L0',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            collapse_detals:true,
            project:{},
            stages_L1:[],
        }
    },
    props:{
        object_id: [String,Number],
        id:[String,Number],
        indexL1:Number,
        index:Number,
        title:String,
        honorar:[Number, String],
        percent: [Number, String],
        percent_def:[Number, String],
        list:Array
    },
    emits:['updatePercent'],
    watch:{

    },
    computed:{
        value(){
            return this.honorar * this.percent/100
        }
    },
    methods:{  
        getProjectData(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
            if(!!this.project.stages_L1&&!!this.project.stages_L1[this.indexL1]) this.stages_L1 = this.project.stages_L1[this.indexL1][this.index]
            this.setValue()
        },
        setValue(){
            this.list.forEach((item, index)=>{
                item.userPercent = ''
                if(!!this.stages_L1[index]) item.userPercent = this.stages_L1[index]
            })
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
        updatePercent(value){
            this.$emit('updatePercent', {value, id:this.id})
        },
        updateProject(){
            if(!this.project.stages_L1[this.indexL1])  this.project.stages_L1[this.indexL1] = []
            this.project.stages_L1[this.indexL1][this.index] = []
            this.list.forEach(index=>{
                this.project.stages_L1[this.indexL1][this.index].push(index.userPercent)
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

    .gap_left{
        margin-left: 30px;
    }

    .wrap{
        width: 100%;
        margin-top: 10px;
    }

    .main_row{
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }   
    .title{
        max-width: 760px;
        margin-left: 55px;
        margin-top: 5px;
        margin-bottom: 5px;
        font-family: 'Raleway-Light';
        font-size: 16px;
        color: #888;
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
        color: #cccccc;
        font-size: 16px;
    }
    .input_percent{
        width: 50px;
        justify-content: flex-end;       
        font-size: 16px;
        color: #999;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 16px;
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