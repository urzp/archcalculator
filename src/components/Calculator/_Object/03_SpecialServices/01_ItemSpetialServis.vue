<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="delete"><CloseButton :heigth="'32px'" @click="deleteItem()"/></div>
            <input class="title" :placeholder="'Leistung eingeben'" :value="title" @change="event => updateUserTitle(event.target.value, item.id)"/>
            <Percent input_type :value = "percent" @edit_value="value=>updatePercent(value)"/>
            <div class="price" ><Price :value ="value" /></div>
        </div>
    </div>
</template>

<script>
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'ItemSpetialServis',
    async mounted(){
    },
    data(){
        return{

        }
    },
    props:{
        id:String,
        title:String,
        honorar:Number,
        percent:Number,
    },
    emits:['deleteItem'],
    watch:{
        loaded(){
            this.getProjectData()
        },
        async id_paragraph(id){
            if(!id) return false
            await this.getProjectData()
        },
        project:{
            handler(){
                this.calc()
            },
            deep: true,
        }
    },
    computed:{
    },
    methods:{
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            this.honorar_calc = this.project.honorar_calc
            this.percent = Number( this.project.payExtra.percent )
        },
        calc(){
            this.honorar_calc = this.project.honorar_calc
            this.value = Number(this.honorar_calc) * Number(this.percent)/100
        },
        updatePercent(value){
            this.percent = value
            this.calc()
            this.updateProjectParagraphData()
        },   
        updateProjectParagraphData(){
            this.project.payExtra.percent = this.percent
            this.project.payExtra.value = this.value
            updateProjectObject(this.object_id, this.project)
        },
        deleteItem(){
            this.$emit('deleteItem',this.id)
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

    .delete{
        position: absolute;
        visibility: hidden;
    }
    .main_row:hover .delete{
        visibility:visible;
    }
</style>