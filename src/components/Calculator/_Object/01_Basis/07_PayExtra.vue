<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <div  class="main_row" >
            <div class="title">Zuschlag</div>
            <Percent input_type :value = "percent" @edit_value="value=>updatePercent(value)"/>
            <div class="price" ><Price :value ="value" /></div>
        </div>
    </div>
</template>

<script>
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'PayExtra_calc',
    async mounted(){
    },
    data(){
        return{
            percent:0,
            project:{},
        }
    },
    props:{
        loaded:Boolean,
        id_paragraph:String,
        object_id:String,
    },
    watch:{
        loaded(){
            this.getProjectData()
        },
        async id_paragraph(id){
            if(!id) return false
            await this.getProjectData()
        },
    },
    computed:{
        value(){
            if(!this.project.payExtra)return 0
            if((!this.project||!this.project.honorar_calc)&&!this.project.honorar_calc===0) return 0
            this.honorar_calc = this.project.honorar_calc
            let value = Number(this.honorar_calc) * Number(this.percent)/100     
            return value     
        }
    },
    methods:{
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            this.percent = Number( this.project.payExtra.percent )
            this.project.payExtra.value = this.value
        },
        updatePercent(value){
            this.percent = value
            this.updateProjectParagraphData()
        },   
        updateProjectParagraphData(){
            this.project.payExtra.percent = this.percent
            this.project.payExtra.value = this.value
            updateProjectObject(this.object_id, this.project)
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