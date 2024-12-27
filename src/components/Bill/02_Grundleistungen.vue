<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">I.<span>Grundleistungen</span></div>
            <div class="hover-panel">
                <UpdateBtn class="button" width="35px" height="28px" @click="set_default_list()"/>
            </div>
        </div>
        <div class="content">
            <div class="object" v-for="item, index in list" :key="item.id">
                <div class="header item_base_servis">
                    <div class="wrap_part">
                        <div class="number bold-text">{{ NumToLetters( index + 1 ) }}.</div>
                        <div class="title bold-text">Honorarobjekt</div>
                    </div>
                    <div class="value bold-text">
                        <InputText_Bill :value="item.name" width="300px"  alight_edit="center"
                        @submit_event="value=>update_value(value, item.id,'name')" 
                        @setDefault="set_defaul(item.id, 'name')"/>
                    </div>
                </div>
                <BillBasicServices :id_bill="actualBill.id" :honorar_object = "item"/>
                <BillLeistungsstand :id_bill="actualBill.id" :honorar_object = "item" />
                <BillBesondereLeistungen  :id_bill="actualBill.id" :honorar_object = "item"/>
                <BillTotalObject :id_bill="actualBill.id" :honorar_object = "item"/>
            </div>
        </div>
        <div v-show="list.length>1" class="total_objects bold-text">
            <div class="">Summ as alles Honorarobjekt</div>
            <PriceBill :value="total_objects" />
        </div>
    </div>  
</template>

<script>
import { Bills, saveBill, setDefaulObjects } from '@/servis/projectBill.js'
import { Project } from '@/servis/projectData.js'
import { toLetters } from '@/servis/functions'
export default{
    name: 'Grundleistungen',
    props:{
        bill_item:[Number, String]
    },
    watch:{
        total_objects(value){
            this.actualBill.total_objects = value
        }
    },
    computed:{
        actualBill(){
            let result = {}
            if(!!Bills&&Bills.length>0) result = Bills[this.bill_item]
            return result
        },
        list(){
            let result = []
            if(!!this.actualBill&&!!this.actualBill.objects) result = this.actualBill.objects
            return result
        },
        total_objects(){
            let result = 0
            if(!!this.actualBill&&!!this.actualBill.objects){
                this.actualBill.objects.forEach(item=>{
                    result = result + item.total
                });
            }
            return result
        },
    },
    methods:{
        NumToLetters(value){
            return toLetters(value).toUpperCase()
        },
        update_value(value, id, name_value){
            let elemet = this.actualBill.objects.find(item=>item.id==id)
            if(name_value=='name') elemet.name = value
            saveBill(this.actualBill.id)
        },
        set_defaul(id, name_value){
            let project_elemet = Project.objects.find(item=>item.id==id)
            let elemet = this.actualBill.objects.find(item=>item.id==id)
            if(name_value=='name') elemet.name = project_elemet.name
            saveBill(this.actualBill.id)
        },
        async set_default_list(){
            await setDefaulObjects(this.actualBill.id)
            saveBill(this.actualBill.id)
            console.log(this.actualBill)

        }
    }

}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
    }

    .content{
        margin-left: 15px;
        margin-bottom: 15px;
    }

    .header {
        margin-right: 12%;
    }

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .header_item{
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #999;
        border-bottom: 1px solid #999;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .title span{
        margin-left: 10px;
    }

    .object{
        margin-bottom: 10px;
    }

    .object .header{
        display: flex;
        column-gap: 15px;
    }

    .wrap_part{
        display: flex;
        column-gap: 15px;
    }

    .item_base_servis{
        display: flex;
        column-gap: 15px;
        justify-content: space-between;
    }

    .total_objects{
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .hover-panel{
        visibility: hidden;
    }

    .header_item:hover .hover-panel{
        visibility: visible;
    }
</style>