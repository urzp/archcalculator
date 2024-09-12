<template>
    <div class="price">
        <div class="unit-price">{{ price.unit }}</div>
        <div class="comma">,</div>
        <div class="cents">{{ price.cent }}</div>
        <div class="currency-sign">€</div>
    </div>
</template>

<script>
export default{
    name: 'Price',
    props:{
        value:[String, Number],
        font_size_unit:{
            type:String,
            default: '20px',            
        },
        font_size_cent:{
            type:String,
            default: '16px',            
        },
        font_family:{
            type:String,
            default: 'Comfortaa-Regular',         
        },
    },
    computed: {
        price(){
            let val = Number(this.value)
            val = val?val:0
            val = Math.round(val * 100) / 100 
            let cent  = String(val).split('.')[1]
            cent = cent?cent:'00'
            cent = cent.length == 1?cent+'0':cent
            let unit = Math.floor(val)
            unit = unit.toLocaleString("de-DE")
            return {
                unit,
                cent
            }
        }
    },
}
</script>

<style scoped>
    .price{
        display: flex;
        align-items: baseline;
        font-family: v-bind(font_family);
        font-size: v-bind(font_size_unit);
    }
    .cents{
        font-size: v-bind(font_size_cent);
    }
    .currency-sign{
        margin-left: 15px;
    }
</style>