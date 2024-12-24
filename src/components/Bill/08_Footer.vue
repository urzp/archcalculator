<template>
    <div class="BillFooter light-text">
        <div class="VAT_included"> Im Betrag von <span><PriceBill :value="val_1"/></span> sind <span><PriceBill :value="val_2"/></span> Mehrwertsteuer enthalten.</div>
        <div class="PleasePay">
            Bitte zahlen Sie den Betrag bis zum 
            <span><InputDate :value="payment_date_bis" @editValue=" date=>actualBill.payment_date.bis=date " /></span> 
            an die unten genannte Bankverbindung.
        </div>
        <div class="bank_details">
            <div class="item_detail">
                <div class="name_detal">Kontoinhaber</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_name" width="300px" 
                    @submit_event="value=>update_value(value,'user_name')" 
                    @setDefault="set_defaul('user_name')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">IBAN:</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_IBAN" width="400px" 
                    @submit_event="value=>update_value(value,'user_IBAN')" 
                    @setDefault="set_defaul('user_IBAN')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">BIC: </div>
                <div class="value_detal">
                    <InputText_Bill :value="user_BIC" width="300px" 
                    @submit_event="value=>update_value(value,'user_BIC')" 
                    @setDefault="set_defaul('user_BIC')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">Institut: </div>
                <div class="value_detal">
                    <InputText_Bill :value="user_Institut" width="300px" 
                    @submit_event="value=>update_value(value,'user_Institut')" 
                    @setDefault="set_defaul('user_Institut')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">USt-Id.-Nr. </div>
                <div class="value_detal">
                    <InputText_Bill :value="user_USt" width="300px" 
                    @submit_event="value=>update_value(value,'user_USt')" 
                    @setDefault="set_defaul('user_USt')"/>
                </div>
            </div>
        </div>
        <div class="VAT_Act">Gem. § 14b Abs. 1 S.4 Umsatzsteuergesetz muss diese Rechnung und ein Zahlungsbeleg für zwei Jahre aufbewahrt werden. Die Aufbewahrungsfrist beginnt mit dem Ende des Kalenderjahres, in dem die Rechnung ausgestellt wurde.  Ein Verstoß kann nach § 26a Abs. 2 UStG mit bis zu 500 EUR Geldbuße geahndet werden.</div>
    </div>
</template>


<script>
import { Bills, saveBill, setPaid } from '@/servis/projectBill.js'
import { user } from '@/servis/globalValues.js'
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
        },
        payment_date_bis(){
            let result = new Date()
            if(!!this.actualBill&&!!this.actualBill.payment_date) result = this.actualBill.payment_date.bis
            return result
        },
        user_name(){
            let result = ''
            if(!!this.actualBill&&!!this.actualBill.user_name) result = this.actualBill.user_name
            return result
        },
        user_IBAN(){
            let result = 'DE00 0000 0000 0000 0000 00'
            if(!!this.actualBill&&!!this.actualBill.user_IBAN) result = this.actualBill.user_IBAN
            return result            
        },
        user_BIC(){
            let result = 'BICBICBICBIC'
            if(!!this.actualBill&&!!this.actualBill.user_BIC) result = this.actualBill.user_BIC
            return result            
        },
        user_Institut(){
            let result = 'Deutsche Bank'
            if(!!this.actualBill&&!!this.actualBill.user_Institut) result = this.actualBill.user_Institut
            return result            
        },
        user_USt(){
            let result = 'DE00000000'
            if(!!this.actualBill&&!!this.actualBill.user_USt) result = this.actualBill.user_USt
            return result            
        }
    },
    methods:{
        async update_value(value, name_value){
            if(name_value=='user_name') this.actualBill.user_name = value
            if(name_value=='user_IBAN') this.actualBill.user_IBAN = value
            if(name_value=='user_BIC') this.actualBill.user_BIC = value
            if(name_value=='user_Institut') this.actualBill.user_Institut = value
            if(name_value=='user_USt') this.actualBill.user_USt = value
            saveBill(this.actualBill.id)
        },
        set_defaul(name_value){
            if(name_value=='user_name') this.actualBill.user_name = user.name
            if(name_value=='user_IBAN') this.actualBill.user_IBAN = user.IBAN
            if(name_value=='user_BIC') this.actualBill.user_BIC = user.BIC
            if(name_value=='user_Institut') this.actualBill.user_Institut = user.Institut
            if(name_value=='user_USt') this.actualBill.user_USt = user.USt
            saveBill(this.actualBill.id)
        },
    }

}
</script>

<style scoped>

.BillFooter{
    padding-top: 15px;
    font-size: 18px;
}

.VAT_included, .PleasePay{
    display: flex;
    column-gap: 5px;
}

.PleasePay span{
    display: flex;
}

.light-text{
    font-family: 'Raleway-Light';
    color: #464646;
}

.bold-text{
    font-family: 'Raleway-Medium';
    color: #2c2c2c;       
}

.bank_details{
    margin: 15px 30px;
}

.item_detail{
    width: 50%;
    display: flex;
    justify-content: space-between;
}

.name_detal{
    width: 30%;
}

.value_detal{
    width: 70%;
}

</style>