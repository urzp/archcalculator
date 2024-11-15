<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <div  class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div  class="main_row" >
            <div class="title">Anrechenbare Kosten</div>
            <div class="message" v-if="limits.outRange_min"> min <Price :value ="limits.min" :typeCurrancy="typeCurrancy"  :noCents="true" /></div>
            <div class="message" v-if="limits.outRange_max"> max <Price :value ="limits.max" :typeCurrancy="typeCurrancy"  :noCents="true" /></div>
            <div class="price" @click="switchDetal(false)"><Price input_type :value ="value_render" @edit_price="newValue=>editValue(newValue)" :typeCurrancy="typeCurrancy"/></div>
        </div>
        <div v-show="!collapse_detals" class="detal-list">
            <FinanceDetal 
                :list="list"
                :id_paragraph="id_paragraph" 
                :typeCurrancy="typeCurrancy"
                :object_id = "object_id"
                :useDetals="useDetals"
                @useDetals="switchDetal(true)"
                @edit_price=" data=>editDetalValue(data) "
                @edit_UserTitle=" data=>editUserTitle(data) "
            />
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { getAllowableCosts, getTypeValue, financeLimits } from '@/servis/calcData.js'
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'Finance_calc',
    async mounted(){
        await this.getData()
        this.getProjectData()       
    },
    data(){
        return{
            collapse_detals:true,
            value: '',
            limits:{},
            typeCurrancy: '€',
            value_detals:'',
            list:[],
            project:{},
            detals:{},
            useDetals:false,
            finance:{},
        }
    },
    props:{
        id_paragraph:[String, Number],
        object_id:[String,Number],
    },
    watch:{
        async id_paragraph(id){
            if(!id) return false
            await this.getData()
            this.getProjectData()
        },
    },
    computed:{
        value_render(){
            let result = this.useDetals?this.value_detals:this.value
            this.checkLimits(result)
            return result
        },
    },
    methods:{
        async getData(){
            this.list = await getAllowableCosts(this.id_paragraph)
            this.typeCurrancy = await getTypeValue(this.id_paragraph)
            this.limits = financeLimits(this.id_paragraph)
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
            if(!this.project.finance.detals) this.project.finance.detals = []
            if(!this.project.finance.userTitle) this.project.finance.userTitle = []
            this.list.forEach((item,index)=>{
                item.value = this.project.finance.detals[index]
                if(!!this.project.finance.userTitle[index]) item.userTitle = this.project.finance.userTitle[index]
            })
            this.switchDetal( this.project.finance.useDetals, false )
        },
        updateProjectParagraphData(){
            this.project.finance.value = this.value
            this.project.finance.detals = this.list.map(item=>!item.value?0:item.value)
            this.project.finance.useDetals = this.useDetals
            this.project.finance.userTitle = this.list.map( item=>!item.userTitle?'':item.userTitle )
            updateProjectObject(this.object_id, this.project)
        },
        editValue(newValue){
            this.value = newValue
            this.updateProjectParagraphData()
        },
        editDetalValue(data){
            let item = this.list.find(item=>item.id == data.id)
            item.value = data.value
            this.updateProjectParagraphData()
        },
        editUserTitle(data){
            let item = this.list.find(item=>item.id == data.id)
            item.userTitle = data.value   
            this.updateProjectParagraphData()
        },
        switchDetal(useDetal, update=true){
            this.useDetals=useDetal; 
            this.value_detals = this.list.reduce((sum, item) =>{ if(!item.value) item.value = 0; return sum + Number(item.value) },0)
            this.value = this.project.finance.value
            if(update) this.updateProjectParagraphData()
            EventBus.emit('switchFinance')
        },
        checkLimits(finance){
            if(!this.limits) return false
            this.limits.outRange_min = finance < this.limits.min
            this.limits.outRange_max = finance > this.limits.max
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
    .title, .message{
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .message{
        display: flex;
        column-gap: 15px;
        color: #464646;
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