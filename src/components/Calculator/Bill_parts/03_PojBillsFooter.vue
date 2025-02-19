<template>
    <div v-if="isBill" class="BillFooter light-text">
        <div v-if="!isLocked" class="hover-panel">
            <UpdateBtn class="button" width="35px" height="28px" @click="set_all_default()"/>
        </div>
        <div class="VAT_included"> {{ text.Im_Betrag_von }} <span><PriceBill :value="val_1"/></span> {{ text.sind }} <span><PriceBill :value="val_2"/></span> {{ text.Mehrwertsteuer_enthalten }}</div>
        <div class="PleasePay">
            {{ text.Bitte_zahlen_Sie_den_Betrag_bis_zum }}
            <span><InputDate :value="payment_date_bis" @editValue=" date=>actualBill.payment_date.bis=date " /></span> 
            {{ text.an_die_unten_genannte_Bankverbindung }}
        </div>
        <div class="bank_details">
            <div class="item_detail">
                <div class="name_detal">{{ text.Kontoinhaber }}</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_name" width="300px" 
                    @submit_event="value=>update_value(value,'user_name')" 
                    @setDefault="set_defaul('user_name')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">{{ text.IBAN }}</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_IBAN" width="400px" 
                    @submit_event="value=>update_value(value,'user_IBAN')" 
                    @setDefault="set_defaul('user_IBAN')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">{{ text.BIC }}</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_BIC" width="300px" 
                    @submit_event="value=>update_value(value,'user_BIC')" 
                    @setDefault="set_defaul('user_BIC')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">{{ text.Institut }}</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_Institut" width="300px" 
                    @submit_event="value=>update_value(value,'user_Institut')" 
                    @setDefault="set_defaul('user_Institut')"/>
                </div>
            </div>
            <div class="item_detail">
                <div class="name_detal">{{ text.USt_Id_Nr }}</div>
                <div class="value_detal">
                    <InputText_Bill :value="user_USt" width="300px" 
                    @submit_event="value=>update_value(value,'user_USt')" 
                    @setDefault="set_defaul('user_USt')"/>
                </div>
            </div>
        </div>
        <div class="VAT_Act">{{ text.Gem_Umsatzsteuergesetz }}</div>
    </div>
</template>


<script>

import { Project, updateProject } from '@/servis/projectData.js'
import { user } from '@/servis/globalValues.js'
import { text } from '@/servis/text.js'
export default{
    name: 'PojBillsFooter',
    data(){
        return{
            text:{
                Im_Betrag_von: text.bill.Im_Betrag_von,
                sind: text.bill.sind,
                Mehrwertsteuer_enthalten: text.bill.Mehrwertsteuer_enthalten,
                Mehrwertsteuer_enthalten: text.bill.Mehrwertsteuer_enthalten,
                Bitte_zahlen_Sie_den_Betrag_bis_zum: text.bill.Bitte_zahlen_Sie_den_Betrag_bis_zum,
                an_die_unten_genannte_Bankverbindung: text.bill.an_die_unten_genannte_Bankverbindung,
                Kontoinhaber: text.bill.Kontoinhaber,
                IBAN: text.bill.IBAN,
                BIC: text.bill.BIC,
                Institut: text.bill.Institut,
                USt_Id_Nr: text.bill.USt_Id_Nr,
                Gem_Umsatzsteuergesetz: text.bill.Gem_Umsatzsteuergesetz,
            }
        }
    },
    props:{
        bill_item:[Number, String]
    },
    computed:{
        isLocked(){
            if(!!Project&&!!Project.project&&Project.project.locked=='1') return true
            return false
        },
        actualBill(){
            let result = {}
            if(!!Project&&!!Project.project) result = Project.project
            return result
        },
        isBill(){
            let result = false
            if(this.actualBill.status=='bill') result = true
            return result            
        },
        val_1(){
            let result = 0
            if(!!this.actualBill.payment_total) result = this.actualBill.payment_total
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
            updateProject()
        },
        set_defaul(name_value){
            if(name_value=='user_name') this.actualBill.user_name = user.name
            if(name_value=='user_IBAN') this.actualBill.user_IBAN = user.IBAN
            if(name_value=='user_BIC') this.actualBill.user_BIC = user.BIC
            if(name_value=='user_Institut') this.actualBill.user_Institut = user.Institut
            if(name_value=='user_USt') this.actualBill.user_USt = user.USt
            updateProject()
        },
        set_all_default(){
            this.actualBill.user_name = user.name
            this.actualBill.user_IBAN = user.IBAN
            this.actualBill.user_BIC = user.BIC
            this.actualBill.user_Institut = user.Institut
            this.actualBill.user_USt = user.USt
            updateProject()
        }
    }

}
</script>

<style scoped>

.BillFooter{
    padding-top: 15px;
    font-size: 18px;
    margin-bottom: 100px;
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

.hover-panel{
    height: 0;
    display: flex;
    justify-content: flex-end;
    visibility: hidden;
}

.hover-panel{
    visibility: hidden;
}

.BillFooter:hover .hover-panel{
    visibility: visible;
}

</style>