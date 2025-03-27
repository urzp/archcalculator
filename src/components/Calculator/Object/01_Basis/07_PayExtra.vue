<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <div  class="main_row" >
            <div class="title">{{ text.Pay_extra }}</div>
            <div class="wrap_figures">
                <div class="wrap_colum wrap_colum_1">
                    <Percent input_type :value = "percent" @edit_value="value=>updatePercent(value)"/>
                </div>
                <div class="wrap_colum wrap_colum_2">
                    <div class="price" ><Price :value ="value" /></div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { Project, setUnSavedStatus } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export  default{
    name: 'PayExtra_calc',
    async mounted(){
        this.getProjectData()
    },
    data(){
        return{
            percent:0,
            project:{},
            text:{
                Pay_extra: text.Calc.Pay_extra,
            }
        }
    },
    props:{
        id_paragraph:[String,Number],
        object_id:[String,Number],
    },
    watch:{
        async id_paragraph(id){
            if(!id) return false
            await this.getProjectData()
        },
        value(){
            this.project.payExtra.value = this.value
        }
    },
    computed:{
        value(){
            if(!this.project.payExtra) return 0
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
        width: 60%;
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .wrap_figures{
        width: 40%;
        display: flex;
        align-items: baseline;
        justify-content: flex-end;
    }
    .wrap_colum{
        display: flex;
        align-items: baseline;
        justify-content: flex-end;
    }
    .wrap_colum_1{
        width: 60%;
    }
    .wrap_colum_2{
        width: 40%;
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