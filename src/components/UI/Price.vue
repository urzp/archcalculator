<template>
    <div class="price">
        <template v-if="true">
        <div class="unit-price">{{ price.unit }}</div>
        <div class="comma">,</div>
        <div class="cents">{{ price.cent }}</div>
        </template>
        <template v-if="input_type">
            <input ref="price_input"  type="text" class="unit-price" :value="price.unit" @change="event => edit_price( event.target.value, price.cent ) " @input="event => validate(event.target.value)"/>
            <div class="comma">,</div>
            <input  type="number" max="99" min="0" class="cents" :value="price.cent"  @change="event => edit_price( price.unit, event.target.value ) "/>      
        </template>
        <div class="currency-sign">€</div>
    </div>
</template>

<script>
export default{
    name: 'Price',
    props:{
        value:[String, Number],
        input_type:{ 
            type: Boolean,
            default: false,
        },
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
    emits:['edit_price'],
    methods:{
        validate(val){
            if(/[^0-9.]/g.test(val)) this.$refs.price_input.value = val.toString().replace(/[^0-9]/g, '');
        },
        edit_price(unit, cent){
            console.log('input = ', unit, cent)
            unit = unit.toString().replace(/[^0-9]/g, '');
            cent = cent.toString().replace(/[^0-9]/g, '');
            if( cent.length > 2 ) cent = cent.slice(cent.length - 2)
            console.log(unit, cent)
            let newPrice = Number(unit) + 0.01 * Number(cent)
            console.log(newPrice)
            this.$emit('edit_price', newPrice)
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
    .unit-price{
        text-align: right;
        font-size: 18px;
        color:#838383;
    }
    .cents{
        font-size: v-bind(font_size_cent);
        text-align: right;
        width: 21px;
        font-size: 16px;
        color:#838383;
    }
    .currency-sign{
        margin-left: 15px;
    }
</style>