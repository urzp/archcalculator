<template>
    <ContextMenu :data ="contextMenu" @pasteАccept="updateListData()"/>
    <div class="wrap">
        <div class="title">Honorar Table</div>
        <div class="table">
            <div class="colum-project-size-value">
                <div class="header">
                    Anrechenbare Kosten
                    <div class="type-value">
                        <div>{{ type_value.value }}</div>
                        <Select_List :data="type_value" right @selected="data=>selectTypeValue(data)"/>
                    </div>
                </div>
                <div class="row-rate-value" v-for="item, index in rate_values" :key="item.id" @contextmenu="contectMenuShow($event, index)">
                    <InputPrice :value="item.value" @submit_event="value=>updateRate(value, item.id )" />
                    <div class="hover-panel">
                        <DeleteButton @click.stop="deleteRate(item.id)" width="35px" heigth="30px"/>
                    </div>
                </div>
                <NewButton style="margin-top: 10px;" width="35px" heigth="30px" @click="newRateValue()"/>
            </div>
            <div class="colum-honorar-zones">
                <div class="header honorar-zones">
                    <div class="honorar-zone" v-for="item, index in honorarZones" :key="item.id"  v-show="index>0">
                        {{ item.name }}
                    </div>
                    <div class="edit-panel">
                        <DeleteButton v-if="honorarZones.length > 1" style="margin-left: 10px;" width="35px" heigth="30px" @click="deleteHonorarZone()"/>
                        <NewButton style="margin-left: 10px;" width="35px" heigth="30px" @click="newHonorarZone()"/>
                    </div>
                </div>
                <div class="header row-zone-value">
                    <div class="zone" :class="`zone-${index}`" v-for="(item, index) in honorarZones" :key="item.id">{{ zoneSubTitle(index) }}</div>
                </div>
                <div class="row-zone-value" v-for="item, index_rate in rate_values" :key="item.id">
                    <div class="zone" :class="`zone-${index_zone}`" v-for="item_zone, index_zone in item.zones" :key="item_zone.id" @contextmenu="contectMenuShow_($event, index_rate, index_zone)">
                        <InputPrice width="100px" :value="item_zone.value" @submit_event="value=>updateRateZone(value, item_zone.id )"/>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
import { lastNumber, convertToRoman, getClipboard, rateFillData, rateZoneFillData } from '@/servis/functions.js'
export default{
    name: 'FeeTable',
    mounted(){
        this.getData()
    },
    data(){
        return{
            type_value:{
                value:'Eur',
                list:[
                    {value:"Eur"},
                    {value:"Hektar"},
                ]
            },
            rate_values:[],
            honorarZones:[],
            contextMenu:{
                positon:{x:50,y:200},
                items:[{id:1, label: 'Paste Сolumn'}]
            },
            updateListTypeData:'',
            newData:[],
        }
    },
    props:{
        id_paragraph:String    
    },
    watch:{
        id_paragraph(){
            this.getData()
        }
    },
    methods:{
        async getData(){
            let result = await apiData({typeData:'FeeTable', id: this.id_paragraph})
            this.rate_values = result.data.rate_values
            this.honorarZones = result.data.honorarZones
            let type_value = result.data.typetype_value.value
            this.type_value.value = !type_value?this.type_value.value:type_value
        },
        async selectTypeValue(data){
            let value = data.value
            this.type_value.value = value
            await apiData({typeData:'updateFeeTableTypeValue', data:{id_paragraph: this.id_paragraph, value}})
        },
        async newRateValue(){
            let number = lastNumber(this.rate_values) + 1
            await apiData({typeData:'newFeeTableRate', data:{id_paragraph: this.id_paragraph, number}})
            this.getData()
        },
        async newHonorarZone(){
            if(this.honorarZones.length==0) await apiData({typeData:'newFeeTableHonorarZone', data:{id_paragraph: this.id_paragraph, number:0, name:''}})
            let number = lastNumber(this.honorarZones)
            number++
            let name = "Honorarzone " + convertToRoman(number)
            await apiData({typeData:'newFeeTableHonorarZone', data:{id_paragraph: this.id_paragraph, number, name}})
            this.getData()
        },
        async updateRate(value, id){
            await apiData({typeData:'updateFeeTableRate', data:{id, value}})
            this.getData()
        },
        async updateRateZone(value, id){
            await apiData({typeData:'updateFeeTableHonorarZonesRateValue', data:{id, value}})
            this.getData()
        },
        async deleteRate(id){
            await apiData({typeData:'deleteFeeTableRate', data:id})
            this.getData()       
        },
        async deleteHonorarZone(){
            let id = this.honorarZones[this.honorarZones.length - 1].id
            await apiData({typeData:'deleteFeeTableHonorarZone', data:id})
            this.getData()  
        },
        zoneSubTitle(index){
            if(index==0) return 'von'
            if(index==this.honorarZones.length - 1) return 'bis'
            return 'bis | von'
        },
        contectMenuShow(e,i){
            e.preventDefault();
            this.contextMenu.positon.x = e.pageX + 20
            this.contextMenu.positon.y = e.pageY - 20
            this.rateFillBufer(i)
        },
        contectMenuShow_(e,index_rate, index_zone){
            e.preventDefault();
            this.contextMenu.positon.x = e.pageX + 20
            this.contextMenu.positon.y = e.pageY - 20
            this.rateZoneFillBufer(index_rate, index_zone)
        },
        async rateFillBufer(index){
            let data = await getClipboard()
            this.updateListTypeData = 'updateListFeeTableRate'
            this.newData = await  rateFillData(this.id_paragraph, index, this.rate_values, data)
            console.log(this.newData)
        },
        async rateZoneFillBufer(index_rate, index_zone){
            let data = await getClipboard()
            this.updateListTypeData = 'updateListRateZoneFeeTable'
            lthis.newData = await  rateZoneFillData( index_rate, index_zone, this.rate_values, data)
            console.log(nthis.newData)
        },
        async updateListData(){
            let typeData = this.updateListTypeData
            let data = this.newData
            await apiData({typeData, data})
            this.getData() 
        }
    }

}
</script>

<style scoped>
    .wrap{
        margin-top: 30px;
    }

    .title{
        font-family: 'Raleway-Light' ;
        font-size: 20px;
    }

    .table{
        margin-top: 20px;
        margin-bottom: 50px;
        display: flex;
        column-gap: 30px;
        font-family: 'Raleway-Regular' ;
        font-size: 18px;
    }

    .header{

        display: flex;
        column-gap: 10px;
        align-items: flex-start;
    }

    .colum-project-size-value .header{
        flex-direction: column;
        align-items: flex-start;
    }

    .type-value{
        display: flex;
        column-gap: 10px;
        align-items: center;
    }

    .honorar-zones{
        display: flex;
        column-gap: 30px;
    }

    .honorar-zone{
        width: 130px;
        text-align: center;
    }

    .colum-project-size-value{
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    .row-rate-value{
        margin-top: 5px;
        display: flex;
        column-gap: 5px;
        justify-content: space-between;
    }

    .colum-honorar-zones{
        display: flex;
        flex-direction: column;
    }
    .edit-panel{
        display: flex;
    }
    
    /* ajst table */

    .row-zone-value{
        display: flex;
        column-gap: 15px;
    }

    .honorar-zones:nth-child(1){
        margin-left: 20px;
    }

    .header.honorar-zones{
        margin-bottom: -7px;
    }
    .zone{
        margin-top:6px ;
        display: flex;
        column-gap: 5px;
    }

    .row-zone-value .zone{
        width: 146px;
    }

    .zone-0{
        width: 100px!important;
        margin-left: -25px;
        margin-right: 41px;
    }

    .zone{
        text-align: center;
    }

    .hover-panel{
        display: flex;
        column-gap: 5px;
        visibility: hidden;
    }

    .row-rate-value:hover .hover-panel{
        visibility: visible;
    }

    .zone:hover .hover-panel{
        visibility: visible;
    }

</style>