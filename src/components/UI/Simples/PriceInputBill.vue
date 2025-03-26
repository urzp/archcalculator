<template>
    <div class="wrap_element" :class="{edit_wrap:edit}" @click.stop>
        <div v-if="!edit" class="price" @click="editStart()">{{ price_unit }}, <span>{{ price_cent }} {{ typeCurrancy }}</span></div>
        <div v-else class="edit_block">
            <div class="wrap_imput">
                <input  type="text" class="unit-price"  ref="thisinput" :value="value" @change="event => edit_price( event )" />                  
                <div class="currancy">{{ typeCurrancy }}</div>
            </div>
            <div class="panel" v-if="!noPanel">
                <UpdateBtn v-if="edit" class="button" width="35px" height="28px" @click="$emit('setDefault')" />
            </div>
        </div>
    </div>
    <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { intToFloat } from '@/servis/functions'
export default{
    name: 'PriceInputBill',
    mounted(){

    },
    data(){
        return{
            edit:false,
        }
    },
    props:{
        value:[String, Number],
        noPanel:{
            type: Boolean,
            default:false
        },        
        typeCurrancy:{
            type: String,
            default: '€',
        },
        bg_input_color:{
            type:String,
            default:'#ebebeb',
        }
    },    
    computed:{
        price_unit(){
            let result = 0
            if(!!this.value){ 
                let value =  Number(this.value) 
                let unit = Math.trunc(value)
                result = unit.toLocaleString("de-DE")
            }
            return result
        },
        price_cent(){
            let result = 0
            if(!!this.value) result = Number(this.value)
            result = intToFloat( result, 2).split('.')[1]
            return result
        }
    },
    emits:['editPrice', 'setDefault'],
    methods:{
        editStart(){
            this.edit = true
            setTimeout( ()=>{ this.$refs.thisinput.focus() }, 300);
        },
        edit_price(event){
            let value = event.target.value
            this.$emit('editPrice', value)
        }
    },
}
</script>

<style scoped>

    .price{
        color: inherit;
        font-size: inherit;
        font-family: 'DroidSans';
        text-align: inherit;
    }

    .price span{
        font-size: medium;
    }

    .edit_wrap{
        position: relative;
        z-index: 100;
    }

    .edit_block{
        display: flex;
    }

    .wrap_imput{
        display: flex;
        align-items: baseline;
        border-radius: 5px;
        background-color: v-bind(bg_input_color);
        padding-left: 10px;
        padding-right: 10px;
    }

    input{
        width: 100%;
        color: inherit;
        font-size: inherit;
        font-family: 'DroidSans';
        text-align: inherit;
    }

    .panel{
        position: relative;
        left: 5px;
        width: 0px;
        z-index: 100;
    }

    .edit_wrap{
        position: relative;
        z-index: 100;
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