<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">IV.<span>Zwischensumme</span></div>
        </div>
        <div class="list">
            <div class="content item_list bold-text">
                <div class="colum colum_1">1. Zwischensumme Netto-Honorare einschließlich Nebenkosten</div>
                <div class="colum colum_2">
                    <PriceBill :value="total_net" />
                </div>
            </div>
            <div class="content item_list bold-text">
                <div class="colum colum_1">
                    <div>2. Umsatzsteuer </div> 
                    <div class="tax">
                        <InputNumber
                            :value = "tax" paramSymb=" %"
                            @editValue = "value=>update_value(value, 'tax')"
                            @setDefault="set_default('tax')"/>
                    </div> 
                </div>
                <div class="colum colum_2">
                    <PriceBill :value="total_tax" />
                </div>
            </div>
            <div class="content item_list bold-text">
                <div class="colum colum_1">3. Brutto-Honorar einschließlich Nebenkosten</div>
                <div class="colum colum_2">
                    <PriceBill :value="total_price" />
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill } from '@/servis/projectBill.js'
export default{
    name: 'Zwischensumme',
    data(){
        return{

        }
    },
    props:{
        bill_item:[Number, String]
    },
    computed:{
        actualBill(){
            let result = {}
            if(!!Bills&&Bills.length>0) result = Bills[this.bill_item]
            return result
        },
        tax(){
            let result = 0
            if(!!this.actualBill&&!!this.actualBill.tax) result=this.actualBill.tax
            return result
        },
        total_net(){
            let result = 0
            if(!!this.actualBill){
                result = Number(this.actualBill.total_objects) + Number( this.actualBill.totalExtraCosts)  + Number(this.actualBill.totalExtraServis)
                this.actualBill.total_net = result
            }
            return result
        },
        total_tax(){
            let result = 0
            if(!!this.actualBill){
                result = this.total_net * this.tax/100 
                this.actualBill.total_tax = result 
            }
            return result
        },
        total_price(){
            let result = 0
            if(!!this.actualBill){
                result = this.total_tax + this.total_net
                this.actualBill.total = result
                saveBill(this.id_bill)
            }
            return result
        }
    },
    methods:{
        update_value(value, name_value){
            let element = this.actualBill
            if(name_value=='tax') element.tax = value
            this.calc_totals()
            
        },
        set_default(name_value, id){
            let element = this.actualBill
            let element_project = Project.project
            if(name_value=='tax') element.tax = element_project.tax
            this.calc_totals()
        },
        calc_totals(){
            this.actualBill.total_tax = this.actualBill.total_net * Number(this.actualBill.tax)/100
            this.actualBill.total = this.actualBill.total_tax + this.actualBill.total_net
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

    .list{
        margin-left: 30px;
        margin-bottom: 15px;
    }

    .item_list{
        display: flex;
    }

    .colum_1{
        width: 89%;
        display: flex;
    }

    .tax{
        margin-left: 5px;
        text-align: right;
    }

    .colum_2{
        width: 11%;
        display: flex;
        justify-content: flex-end;

    }

</style>