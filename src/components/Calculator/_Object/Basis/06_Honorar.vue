<template>
    <div class="item-Part-obj" v-if="!!id_paragraph">
        <div  class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div  class="main_row" >
            <div class="title">Honorar nach Honorartafel</div>
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
import { Project, updateProjectObject } from '@/servis/projectData.js'
export  default{
    name: 'Honorar_calc',
    async mounted(){
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
        }
    },
    props:{
        loaded:Boolean,
        id_paragraph:String,
        object_id:String,
    },
    watch:{
        async loaded(){
            await this.getData()
            await this.getProjectData()
            this.calculateTable()          
        },
        async id_paragraph(){
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
            if(!this.honorarTable) return false
            this.finance_min = Number( this.honorarTable[0].value )
            this.finance_max = Number( lastElement( this.honorarTable ).value )
        },
        async getProjectData(){
            this.project = await Project.objects.find(item=>item.id==this.object_id)
        },
        finance(){
            if( !this.project.finance ) return 0 
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
            if(!this.honorarTable) return false
            if( !this.checkLimits() ) return false

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
        updateProjectParagraphData(){
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