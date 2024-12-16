<template>
    <div v-if="isSelected" class="bills_wrap">
        <CalcTitle no_full_inf></CalcTitle>
        <BillsList></BillsList>
        <div class="title_bill">
            <div class="name">Bill:</div>
            <div class="devide_part"></div>
        </div>
        <BillHeader :bill_item="selectedBill"/>
        <Grundleistungen/>
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
import { newBill, Bills, clearBills } from '@/servis/projectBill.js'
import { global } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'Bill',
    mounted(){
        EventBus.on('MenuProjects:showBills', ()=>this.openBills())
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
        }
    },
    methods:{
        async getData(){
            await clearBills()
            if(!this.project_id) return false
        },
        async openBills(number='last'){
            if(this.list.length == 0) await this.newBill()
            if(number=='last') { this.selectedBill = this.list.length - 1 } else { this.selectedBill = number }
            
        },
        async newBill(){
           let bill = await newBill(this.project_id, this.list.length)
           this.list.push(bill)
        }
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

</style>