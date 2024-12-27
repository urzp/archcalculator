<template>
    <div v-if="isSelected" class="bills_wrap">
        <!-- <CalcTitle no_full_inf></CalcTitle> -->
        <BillsList :list="list" @selectBill="(value)=>selectBill(value)"></BillsList>
        <template v-if="list.length>0">
        <template v-if="!loadEffect" >
        <div class="title_bill" ref="begin">
            <div class="name">
                <div class="leftPart">
                    <div class="title">Rechnung:</div>
                    <div class="title_value bold-text">
                        <InputText_Bill noUpdate :value="bill_name" width="300px" 
                        @submit_event="value=>update_title(value)"/>
                    </div>
                </div>
                <div class="invoice_number">
                    <InputText_Bill noUpdate :value="invoice_number" width="200px" alight_edit="center"
                    @submit_event="value=>update_invoice_number(value)"/>
                </div>
            </div>
            <div class="devide_part"></div>
        </div>
        <BillHeader :bill_item="selectedBill"/>
        <Grundleistungen :bill_item="selectedBill"/>
        <AdditionalLeistungen :bill_item="selectedBill"/>
        <Nebenkosten  :bill_item="selectedBill"/>
        <Zwischensumme :bill_item="selectedBill"/>
        <GesamtRest  :bill_item="selectedBill"/>
        <Rechnungsbetrag  :bill_item="selectedBill"/>
        <BillFooter :bill_item="selectedBill"/>
        <div class="devide_part"></div>
        <div class="bottum_line"></div>
        <ExportPanel :bill_item="selectedBill"/>
        </template>
        <div v-else class="load">Loading . . . </div>
        </template>
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
        EventBus.on('Bills:selectBill', id=>{this.selectBillById(id)} )
    },
    data(){
        return{
            selectedBill:'',
            loadEffect:false,
        }
    },
    props:{
        project_id:String,
    },
    watch:{
        project_id(){
            this.getData()
        },
        listLenght(value){
            if(!!this.selectedBill&&this.selectedBill + 1 > value) this.selectedBill = value - 1
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
        },
        invoice_number(){
            let result = ''
            if(this.isSelected&&!!this.list&&this.list.length>0&&!!this.list[this.selectedBill]) result = this.list[this.selectedBill].invoice_number
            return result
        },
        list(){
            let result = []
            if(!!Bills) result = Bills
            return result
        },
        listLenght(){
            let result = 0
            if(!!this.list) result = this.list.length
            return result
        }
    },
    methods:{
        selectBill(index){
            this.selectedBill=index
            this.loadEffect = true
            setTimeout(()=>{this.loadEffect = false}, 500)
        },
        selectBillById(id){
            let index = Bills.findIndex(item=>item.id==id)
            this.selectedBill = index
            this.$refs.begin.scrollIntoView({behavior: 'smooth'});
        },
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
           let bill = await newBill(this.project_id)
           this.list.push(bill)
           this.selectedBill = this.list.length - 1
        },
        async update_title(value){
            let id = this.list[this.selectedBill].id
            this.list[this.selectedBill].name = value
            saveBill(id)
        },
        async update_invoice_number(value){
            let id = this.list[this.selectedBill].id
            this.list[this.selectedBill].invoice_number = value
            this.list[this.selectedBill].paid.invoice_number = value
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

    .leftPart{
        display: flex;
        column-gap: 10px;
        align-items: baseline;
    }

    .name{
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        column-gap: 15px;
    }

    .name .title{
        font-size: 18px;
    }

    .name .title_value{
        font-size: 20px;
    }

    .load{
        min-height: 500px;
        margin-top: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
    }

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }
</style>