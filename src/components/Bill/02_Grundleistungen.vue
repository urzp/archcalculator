<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">I.<span>Grundleistungen</span></div>
        </div>
        <div class="content">
            <div class="object" v-for="item, index in list" :key="item.id">
                <div class="header item_base_servis">
                    <div class="wrap_part">
                        <div class="number bold-text">{{ NumToLetters( index + 1 ) }}.</div>
                        <div class="title bold-text">Honorarobjekt</div>
                    </div>
                    <div class="value bold-text">
                        <InputText_Bill :value="item.name" width="300px" 
                        @submit_event="value=>update_value(value, item.id,'name')" 
                        @setDefault="set_defaul(item.id, 'name')"/>
                    </div>
                </div>
                <BillBasicServices :honorar_object = "item"/>
                <BillLeistungsstand/>
                <BillBesondereLeistungen/>
            </div>
        </div>
    </div>  
</template>

<script>
import { Bills, saveBill } from '@/servis/projectBill.js'
import { Project } from '@/servis/projectData.js'
import { toLetters } from '@/servis/functions'
export default{
    name: 'Grundleistungen',
    props:{
        bill_item:[Number, String]
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
        }
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

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .header_item{
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
</style>