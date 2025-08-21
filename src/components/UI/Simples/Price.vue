<template>
    <div class="price" @click="checkLock()">
        <template v-if="!input_type||isLocked">
            <div class="unit-price">{{ price.unit }}</div>
            <template v-if="!noCents&&typeCurrancy!='Hektar'">
                <div class="comma">,</div>
                <div class="cents">{{ price.cent }}</div>
            </template>
        </template>
        <template v-else >
            <input ref="input_unit" type="text" class="unit-price" 
            :value="price.unit" 
            @change="event => edit_price( event.target.value, price.cent )" 
            @input="event => { validateUnit(event) }" 
            @focus="event => { validateUnit(event) }"
            @keydown="event=>{ focus_cent(event) }"/>
            <template v-if="!noCents&&typeCurrancy!='Hektar'">
            <div class="comma">,</div>
            <input ref="input_cent"   type="text" class="cents" 
            :value="price.cent"  
            @change="event => edit_price( price.unit, event.target.value )"  
            @input="event => { validateCent(event) }"
            @keydown="event=>{ focus_unit(event) }"/>      
            </template>
        </template>
        <div class="currency-sign" :class="{wide_sing:typeCurrancy!='€'}">{{ typeCurrancy }}</div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { checkLock, Project } from '@/servis/projectData';
export default{
    name: 'Price',
    mounted(){
        this.count_price()
    },
    data(){
        return{
            price:{
                unit:'0',
                cent:'00'
            },
        }
    },
    computed:{
        isLocked(){
            if(!!Project&&!!Project.project&&Project.project.locked=='1') return true
            return false
        },
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
        input_type:{ 
            type: Boolean,
            default: false,
        },
        font_family:{
            type:String,
            default: 'DroidSans',         
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
    emits:['edit_price'],
    methods:{
        validateUnit(event){
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
        edit_price(unit, cent){
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
        },
        checkLock(){
            checkLock()
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
    }
}
</script>

<style scoped>
    .price{
        display: flex;
        align-items: baseline;
        font-family: v-bind(font_family);
    }
    .unit-price{
        text-align: right;
    }
    .cents{
        text-align: center;
        width: 23px;
    }
    .currency-sign{
        margin-left: 5px;
        margin-right: 10px;
    }
    .wide_sing{
        min-width: 20px;
    }
    input{
        width: v-bind(input_width);
        font-family:inherit;
        color: inherit;
    }
</style>