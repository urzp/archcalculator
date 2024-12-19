<template>
    <div v-if="isSelected" class="bills_wrap">
        <!-- <CalcTitle no_full_inf></CalcTitle> -->
        <BillsList :list="list" @selectBill="(value)=>selectedBill=value"></BillsList>
        <div class="title_bill">
            <div class="name">
                <div class="title">Rechnung:</div>
                <InputText :value="bill_name" width="300px" @submit_event="value=>update_title(value)"/>
            </div>
            <div class="devide_part"></div>
        </div>
        <BillHeader :bill_item="selectedBill"/>
        <Grundleistungen :bill_item="selectedBill"/>
        <AdditionalLeistungen/>
        <Nebenkosten/>
        <Zwischensumme/>
        <GesamtRest/>
        <Rechnungsbetrag/>
        <BillFooter/>
        <div class="devide_part"></div>
        <div class="bottum_line"></div>
    </div>
</template>


<script>
import { EventBus } from '@/servis/EventBus'
import { newBill, Bills, LoadBills, clearBills } from '@/servis/projectBill.js'
import { saveBill } from '@/servis/projectBill.js'
export default{
    name: 'Bill',
    mounted(){
        EventBus.on('MenuProjects:showBills', ()=>this.openBills())
        EventBus.on('MenuProjects:new', clearBills) 
        EventBus.on('MenuProjects:newBill', this.newBill)
    },
    data(){
        return{
            list:Bills,
            selectedBill:'',
        }
    },
    props:{
        project_id:String,
    },
    watch:{
        project_id(){
            this.getData()
        }
    },
    computed:{
        isSelected(){
            let result = false
            if(!!this.project_id&&!!this.selectedBill||this.selectedBill==0) result = true
            return result
        },
        bill_name(){
            let result = ''
            if(this.isSelected&&!!this.list&&this.list.length>0&&!!this.list[this.selectedBill]) result = this.list[this.selectedBill].name
            return result
        }
    },
    methods:{
        async getData(){
            await clearBills()
            if(!this.project_id) return false
            await LoadBills(this.project_id)
        },
        async openBills(number='last'){
            if(this.list.length == 0) await this.newBill()
            if(number=='last') { this.selectedBill = this.list.length - 1 } else { this.selectedBill = number }
            
        },
        async newBill(){
           let bill = await newBill(this.project_id, this.list.length)
           this.list.push(bill)
           this.selectedBill = this.list.length - 1
        },
        async update_title(value){
            let id = this.list[this.selectedBill].id
            this.list[this.selectedBill].name = value
            saveBill(id)
        },
    }

}
</script>

<style scoped>
    .title_bill .name, .bottum_line{
        font-family: 'Raleway-Light';
        color: #3d3d3d;
        font-size: 24px;
        border-bottom: 1px solid #999999;
    }

    .devide_part{
        width: 100%;
        height: 40px;
        margin-top: 15px;
        margin-bottom: 10px;
        background-color: #F5F5F5;
    }

    .name{
        display: flex;
        align-items: baseline;
        column-gap: 15px;
    }

    .name .title{
        font-size: 18px;
    }
</style>