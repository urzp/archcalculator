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
            <HonorarDetal_calc :data = "table_render" />
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
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
        id_paragraph:String,
        object_id:String,
    },
    watch:{
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
            let honorarTable = this.honorarTable
            if(!honorarTable||!honorarTable.typetype_value) return {}
            if(!honorarTable.typetype_value[0].value) return 'Eur'
            return  honorarTable.typetype_value[0].value
        }
    },
    methods:{
        async getData(){
            let result = await apiData({typeData:'FeeTable', id: this.id_paragraph})
            this.honorarTable = result.data

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
        ifRangeInFinfnce(){
            if(!this.honorarTable.rate_values||!this.honorarTable.rate_values[0]) return false
            let result
            let finance = {}
            finance.min = Number( this.honorarTable.rate_values[0].value )
            finance.max = Number(  lastElement( this.honorarTable.rate_values ).value )
            result = this.finance()>=finance.min&&this.finance()<=finance.max
            
            finance.outRange_min = this.finance()<finance.min
            finance.outRange_max = this.finance()>finance.max
            EventBus.emit('financeLimits',finance)
            return result
        },
        calculateTable(){
            if(!this.honorarTable) return false
            let finance = this.finance()
            if( !this.ifRangeInFinfnce() ) return false
            let honorarNumber = this.project.honorarLevel.number
            let honorarRate = this.project.HonorarRate.percent
            let table_rates = this.honorarTable.rate_values
            let low = this.table_render.low
            let current = this.table_render.current
            let up = this.table_render.up

            let low_item = table_rates.reverse().find(item=>finance >= item.value )
            let up_item = table_rates.reverse().find(item=>finance < item.value )

            low.funding = Number( low_item.value )
            current.funding = finance
            up.funding = Number( up_item.value )

            low.min_fee = Number( low_item.zones[honorarNumber - 1].value )
            low.max_fee = Number(  low_item.zones[honorarNumber].value )

            up.min_fee = Number(  up_item.zones[honorarNumber - 1].value )
            up.max_fee = Number( up_item.zones[honorarNumber].value )

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