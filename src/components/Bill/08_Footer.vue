<template>
    <div class="BillFooter light-text">
        <div class="VAT_included"> Im Betrag von <span><PriceBill :value="val_1"/></span> sind <span><PriceBill :value="val_2"/></span> Mehrwertsteuer enthalten.</div>
        <div class="PleasePay">Bitte zahlen Sie den Betrag bis zum T. MMM. JJJJ an die unten genannte Bankverbindung.</div>
        <div class="bank_details">
            <div class="item_detail">
                <div class="name_detal">Kontoinhaber</div>
                <div class="value_detal">Viktor Filimonow</div>
            </div>
        </div>
        <div class="VAT_Act">Gem. § 14b Abs. 1 S.4 Umsatzsteuergesetz muss diese Rechnung und ein Zahlungsbeleg für zwei Jahre aufbewahrt werden. Die Aufbewahrungsfrist beginnt mit dem Ende des Kalenderjahres, in dem die Rechnung ausgestellt wurde.  Ein Verstoß kann nach § 26a Abs. 2 UStG mit bis zu 500 EUR Geldbuße geahndet werden.</div>
    </div>
</template>


<script>
import { Bills } from '@/servis/projectBill.js'
import { intToFloat } from '@/servis/functions'
export default{
    name: 'BillFooter',
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
        val_1(){
            let result = 0
            if(!!this.actualBill&&!!this.actualBill.total_rest) result = this.actualBill.total_rest
            return result
        },
        val_2(){
            let result = 0
            if(!!this.actualBill){
                result = this.val_1 * (this.actualBill.tax/100)
            }
            return result
        }
    }

}
</script>

<style scoped>

.BillFooter{
    padding-top: 15px;
    font-size: 18px;
}

.VAT_included{
    display: flex;
    column-gap: 5px;
}

.light-text{
    font-family: 'Raleway-Light';
    color: #464646;
}

.bold-text{
    font-family: 'Raleway-Medium';
    color: #2c2c2c;       
}

.item_detail{
    width: 50%;
    margin: 15px 30px;
    display: flex;
    justify-content: space-between;
}

</style>