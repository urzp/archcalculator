<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <DetalMarker @click="collapse_detals=!collapse_detals" :collapse="collapse_detals"/>
        <div  class="main_row" >
            <div class="title">{{ text.Fee_according_to_fee_table }}</div>
            <div class="price" ><Price :value ="value" /></div>
        </div>
        <div v-show="!collapse_detals" class="detal-list">
            <HonorarDetal_calc :data = "table_render" :typeValue="typeValue" />
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { getFeeTable, getTypeValue } from '@/servis/calcData.js'
import { lastElement } from '@/servis/functions.js'
import { Project } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export  default{
    name: 'Honorar_calc',
    async mounted(){
        await this.getData()
        await this.getProjectData()
        this.calculateTable()  
        EventBus.on('switchFinance', this.calculateTable )
    },
    data(){
        return{
            collapse_detals:true,
            value: '',
            finance_min:'',
            finance_max:'',
            table_render:{
                low:{},
                current:{
                    funding:''
                },
                up:{},
            },
            honorarTable:{},
            project:{},
            text:{
                Fee_according_to_fee_table: text.Calc.Fee_according_to_fee_table,
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
            await this.getData()
            await this.getProjectData()
            this.calculateTable()
        },
        project:{
            handler(){
                this.calculateTable()
            },
            deep:true,
        },
    },
    computed:{
        typeValue(){
            return  getTypeValue(this.id_paragraph)
        }
    },
    methods:{
        async getData(){
            this.honorarTable = await getFeeTable(this.id_paragraph)
            if(!this.honorarTable||!this.honorarTable[0]) return false
            this.finance_min = Number( this.honorarTable[0].value )
            this.finance_max = Number( lastElement( this.honorarTable ).value )
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
        },
        finance(){
            if( !this.project||!this.project.finance ) return 0 
            let finance = this.project.finance 
            if( finance.useDetals ){
                return finance.detals.reduce((sum, item) => sum + Number(item),0)
            }else{
                return  Number(finance.value)
            }
        },
        checkLimits(){
            return this.finance()>=this.finance_min&&this.finance()<=this.finance_max
        },
        findFinanceGap(finance){
            this.table_render.low = this.honorarTable.reverse().find(item=>finance >= item.value )
            this.table_render.up = this.honorarTable.reverse().find(item=>finance < item.value )
            let length = Number( this.honorarTable.length ) - 1
            if(!this.table_render.low) { this.table_render.low = this.honorarTable[0]; this.table_render.up  = this.honorarTable[1];}
            if(!this.table_render.up) { this.table_render.low = this.honorarTable[length - 1];  this.table_render.up  = this.honorarTable[length];  }
        },
        calculateTable(){
            if(!this.project) return false
            if(!this.honorarTable) { this.renderNone(); return false }
            if( !this.checkLimits() ) { this.renderNone(); return false }

            let finance = this.finance()
            this.findFinanceGap(finance)

            let honorarNumber = this.project.honorarLevel.number
            let honorarRate = this.project.HonorarRate.percent

            let low = this.table_render.low
            let current = this.table_render.current
            let up = this.table_render.up

            low.funding = Number( low.value )
            current.funding = finance
            up.funding = Number( up.value )

            if(honorarNumber>low.zones.length - 1) honorarNumber = low.zones.length - 1
            low.min_fee = Number( low.zones[honorarNumber - 1].value )
            low.max_fee = Number(  low.zones[honorarNumber].value )

            up.min_fee = Number(  up.zones[honorarNumber - 1].value )
            up.max_fee = Number( up.zones[honorarNumber].value )

            let rateBetweenfinding = (current.funding - low.funding)/(up.funding - low.funding)
            current.min_fee = (up.min_fee - low.min_fee)*rateBetweenfinding + low.min_fee
            current.max_fee = (up.max_fee - low.max_fee)*rateBetweenfinding + low.max_fee

            this.value = (current.max_fee - current.min_fee) * honorarRate/100 + current.min_fee
            this.project.honorar_calc = this.value
        },
        renderNone(){
            let noneValue = {funding:'-', min_fee:'-', max_fee:'-'}
            this.table_render.low = noneValue
            this.table_render.current = noneValue
            this.table_render.up = noneValue
            this.value = 0
            this.project.honorar_calc = this.value
        },
        
    }
}

</script>

<style scoped>
    .main_row{
        display: flex;
        /* height: 35px; */
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