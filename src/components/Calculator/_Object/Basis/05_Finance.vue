<template>
    <div class="item-Part-obj">
        <div  class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div  class="main_row" >
            <div class="title">Anrechenbare Kosten</div>
            <div class="price" @click="switchDetal(false)"><Price :input_type="true" :value ="value" @edit_price="newValue=>editValue(newValue)"/></div>
        </div>
        <div v-show="!collapse_detals" class="detal-list">
            <FinanceDetal 
                :list="list"
                :id_paragraph="id_paragraph" 
                :object_id = "object_id"
                :useDetals="useDetals"
                @useDetals="switchDetal(true)"
                @edit_price=" data=>editDetalValue(data) "
            />
        </div>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'Finance_calc',
    async mounted(){
    },
    data(){
        return{
            collapse_detals:true,
            value: '4500',
            list:[],
            project:{},
            detals:{},
            useDetals:false,
        }
    },
    props:{
        id_paragraph:String,
        object_id:String,
    },
    watch:{
        async id_paragraph(){
            await this.getData()
            this.getProjectData()
        }
    },
    computed:{
        
    },
    methods:{
        async getData(){
            let result = (await apiData({typeData:'calc:AllowableCosts', id_paragraph: this.id_paragraph })).data
            this.list = result
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            this.list.forEach((item,index)=>item.value = this.project.finance.detals[index])
            this.switchDetal( this.project.finance.useDetals, false )
        },
        updateProjectParagraphData(){
            this.project.finance.value = this.value
            this.project.finance.detals = this.list.map(item=>!item.value?0:item.value)
            this.project.finance.useDetals = this.useDetals
            updateProjectObject(this.object_id, this.project)
        },
        editValue(newValue){
            this.value = newValue
            this.updateProjectParagraphData()
        },
        editDetalValue(data){
            let el = this.list.find(item=>item.id == data.id)
            el.value = data.value
            this.updateProjectParagraphData()
        },
        switchDetal(useDetal, update=true){
            this.useDetals=useDetal; 
            if(useDetal){
                this.value = this.list.reduce((sum, item) => sum + Number(item.value),0)
            }else{
                this.value = this.project.finance.value
            }
            if(update) this.updateProjectParagraphData()
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
</style>