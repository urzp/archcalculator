<template>
    <div class="wrap_element" :class="{edit_wrap:edit}" @click.stop>
        <div v-if="!edit" class="price" @click="editStart()">{{ price_unit }}, <span>{{ price_cent }} {{ typeCurrancy }}</span></div>
        <div v-else class="edit_block">
            <div class="wrap_imput">
                <input  type="text" class="unit-price"  ref="input_unit" 
                :value="price_unit" 
                @input="event => edit_price( event )" 
                @keydown="event=>{ focus_cent(event) }"/>
                <div class="comma">,</div>
                <input ref="input_cent"   type="text" class="cents" 
                    :value="price_cent"  
                    @input="event => { validateCent(event) }"
                    @keydown="event=>{ focus_unit(event) }"/>                      
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
        },
        lock:{
            type:[Boolean, String],
            default: false,
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
            setTimeout( ()=>{ this.$refs.input_unit.focus() }, 300);
        },
        edit_price(event){
            let position = event.target.selectionStart
            let val = event.target.value
            let len = val.length
            val = val.replaceAll('.','')

            if(/[^0-9]/g.test(val)){
                val = val.toString().replace(/[^0-9]/g, '');
                event.target.value = val
                event.target.setSelectionRange(position-1, position-1)
            }
            event.target.value = Number(val).toLocaleString('de-DE')
            let dif_len = len - event.target.value.length
            position = position - dif_len
            event.target.setSelectionRange(position, position)
            this.$emit('editPrice', val)
        },
        validateCent(event){
            let position = event.target.selectionStart
            let val = event.target.value
            let len = val.length
            if(/[^0-9]/g.test(val)){
                val = val.toString().replace(/[^0-9]/g, '');
                event.target.value = val
                event.target.setSelectionRange(position-1, position-1)
                len--;
            }
            if( len > 2 ) { 
                let val_arr = val.split('')
                if(position==3) val = val_arr[0] + val_arr[2]
                if(position==2) val = val_arr[1] + val_arr[2]
                if(position==1) val = val_arr[0] + val_arr[2]
                event.target.value = val
            }                       
        },
        focus_cent(event){
            let position = event.target.selectionStart
            let len =  event.target.value.length
            let  key = event.key
            if(key==','||key=='.'){
                this.$refs.input_cent.focus()
            }
            if(key=='ArrowRight'&&len==position){
                this.$refs.input_cent.focus()
            }
        },
        focus_unit(event){
            let position = event.target.selectionStart
            let  key = event.key
            if(key=='ArrowLeft'&&position==0){
                this.$refs.input_unit.focus()
            }
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

    .cents{
        font-size: medium;
        text-align: center;
        width: 23px;
    }

    .edit_wrap{
        position: relative;
        z-index: 100;
    }

    .edit_block{
        display: flex;
        width: 153px;
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

    .currancy{
        color: inherit;
        font-size: inherit;
        font-family: 'DroidSans';
        text-align: inherit;      
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