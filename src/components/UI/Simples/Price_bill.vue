<template>
    <div class="wrap_element" :class="{edit_wrap:edit}" @click.stop>
        <div class="price" :class="{edit}">
            <input  type="text" class="unit-price" 
                :value="price.unit" @change="event => edit_price( event.target.value, price.cent )" 
                @input="event => { validate(event) }" @focus="event => { edit=true;validate(event) }"/>
            <template v-if="!noCents&&typeCurrancy!='Hektar'">
            <div class="comma">,</div>
            <input  
                type="number" max="99" min="0" class="cents" 
                @focus="edit=true"
                :value="price.cent"  
                @change="event => edit_price( price.unit, event.target.value )"  
                @input="event => { validate(event, true) }"/>      
            </template>
            <div class="currency-sign">{{ typeCurrancy }}</div>
        </div>
        <div class="panel">
            <UpdateBtn v-if="edit" class="button" width="35px" height="28px" @click="$emit('setDefault')" />
        </div>
    </div>
    <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'Price_Bill',
    mounted(){
        this.count_price()
    },
    data(){
        return{
            price:{
                unit:'0',
                cent:'00',
            },
            edit:false,
            
        }
    },
    props:{
        value:[String, Number],
        noCents:{
            type: Boolean,
            default:false
        },
        typeCurrancy:{
            type: String,
            default: '€',
        },
        font_size_unit:{
            type:String,
            default: '18px',            
        },
        font_size_cent:{
            type:String,
            default: '16px',            
        },
        font_family:{
            type:String,
            default: 'Comfortaa-Regular',         
        },
        name_value:{
            type:String,
            default:'',
        },
        search_data:{
            typeof:Object,
            default:{id_parent:'0', id:'0'}
        },
        input_width:{
            type:String,
            default:'120px',         
        }
    },    
    watch: {
        value(){
            this.count_price()
        }
    },
    emits:['edit_price', 'setDefault'],
    methods:{
        validate(event, cent_section=false){
            let val = event.target.value
            let position = event.target.selectionStart - 1
            if(/[^0-9]/g.test(val)){
                event.target.value = val.toString().replace(/[^0-9]/g, '');
                event.target.setSelectionRange(position, position)
            }
            if(cent_section){
                let cent = event.target.value
                if( cent.length > 2 ) {
                    event.target.value = cent.slice(0,-1)
                }
            }
        },
        edit_price(unit, cent){
            this.edit = false
            unit = unit.toString().replace(/[^0-9]/g, '');
            cent = cent.toString().replace(/[^0-9]/g, '');
            if( cent.length > 2 ) cent = cent.slice(0,-1)
            let newPrice = Number(unit) + 0.01 * Number(cent)
            this.$emit('edit_price', newPrice)
            EventBus.emit('edit:input',{ parent_item:this.search_data.id_parent , id_item: this.search_data.id , value:newPrice})
            this.count_price()
        },
        count_price(){
            let val = Number(this.value)
            val = val?val:0
            val = Math.round(val * 100) / 100 
            let cent  = String(val).split('.')[1]
            cent = cent?cent:'00'
            cent = cent.length == 1?`${cent}0`:cent
            let unit = Math.floor(val)
            unit = unit.toLocaleString("de-DE")
            this.price = {
                unit,
                cent
            }
        }
    }
}
</script>

<style scoped>
    .wrap_element{
        display: flex;
        column-gap: 2px;
    }
    .edit_wrap{
        position: relative;
        z-index: 100;
    }

    .price{
        display: flex;
        align-items: baseline;
        font-family: v-bind(font_family);
    }
    .unit-price{
        text-align: right;
        font-size: v-bind(font_size_unit);
    }
    .cents{
        font-size: v-bind(font_size_cent);
        text-align: right;
        width: 23px;
    }
    .currency-sign{
        margin-left: 5px;
    }
    input{
        width: v-bind(input_width);
        font-family:inherit;
        color: inherit;
    }

    .edit{
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        padding-right: 15px;
    }

    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
</style>