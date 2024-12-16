<template>
    <div class="BillFooter light-text">
        <div class="VAT_included">{{ `Im Betrag von ${val_1} sind ${val_2} Mehrwertsteuer enthalten.` }}</div>
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
export default{
    name: 'BillFooter',
    data(){
        return{
            val_1: 0,
            val_2: 0,
        }
    }

}
</script>

<style scoped>

.BillFooter{
    padding-top: 15px;
    font-size: 18px;
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