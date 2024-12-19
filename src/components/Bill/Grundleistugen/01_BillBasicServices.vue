<template>
    <div class="honorar item_base_servis light-text">
        <div class="wrap_part">
            <div class="number">1.</div>
            <div class="title">Honorarzone und Honorarsatz</div>
        </div>
        <div class="wrap_part">
            <div class="zone">{{ honorar_zone }}</div>
            <div class="satz">{{ honorar_satz }}</div>
        </div>
    </div>
    <div class="honorar item_base_servis light-text">
        <div class="wrap_part">
            <div class="number">2.</div>
            <div class="title">Anrechenbaren Kosten</div>
        </div>
        <div class="satz"> 823 439,66 € </div>
    </div>
    <div class="honorar item_base_servis light-text">
        <div class="wrap_part">
            <div class="number">3.</div>
            <div class="title">Rechnerisches Gesamthonorar LPH 1-9</div>
        </div>
        <div class="satz bold-text"> 109 539,94 € </div>
    </div>
</template>

<script>
export default{
    name: 'BillBasicServices',
    props:{
        honorar_object: Object,
    },
    computed:{
        honorar_zone(){
            let result = '-'
            if(!!this.honorar_object&&!!this.honorar_object.honorar_zone) result = this.honorar_object.honorar_zone
            return result
        },
        honorar_satz(){
            let result = '-'
            if(!!this.honorar_object&&this.honorar_object.honorar_satz) result = this.honorar_object.honorar_satz
            return result
        }
    }

}
</script>

<style scoped>

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
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

