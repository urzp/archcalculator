<template>
    <div class="wrap_element">
        <div class="percent"   @click.stop :class="{edit}"> 
            <input  ref="imput_pecent" type="text"  class="value" 
                @focus="edit=true"
                :value="value.toLocaleString('DE-de')" 
                @change="event => edit_value(event)" 
                @input="event => { validate(event) }"/>
            <div class="sumbol">%</div>
        </div>
        <div class="panel" v-if="!noUpdate" @click.stop>
            <UpdateBtn v-if="edit" class="button" width="35px" height="28px" @click="$emit('setDefault')" />
        </div>
        <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div> 
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export  default{
    name: 'Percent_Bill',
    mounted(){
        this.adjast_input_width()
    },  
    data(){
        return{
            edit:false,
            
        }
    },
    props:{
        value: [String,Number],
        noUpdate:{
            type:Boolean,
            default:false,
        },
        search_data:{
            typeof:Object,
            default:{id_parent:'0', id:'0'}
        },
        font_size_sumbol:{
            type:String,
            default: '16px',            
        },
    }, 
    emits:['edit_value', 'setDefault'],
    methods:{
        validate(event){
            let val = event.target.value
            let position = event.target.selectionStart - 1
            
            if(val[0] == '0' &&val.length > 0){
                val = val.slice(1);
                event.target.value = val
                event.target.setSelectionRange(position, position)
            }
            if(/[^0-9,.]/g.test(val)){
                val = val.replace(/[^0-9,.]/g, '')
                event.target.value = val
                event.target.setSelectionRange(position, position)
            }
            if(/[.]/g.test(val)){
                val = val.replace(/[.]/g, ',');
                event.target.value = val
                event.target.setSelectionRange(position+1, position+1)
            }
            if(val[0]==','){
                val = `0${val}`
                event.target.value = val
                event.target.setSelectionRange(position+1, position+1)
            }
            let val_num = Number(val.replace(',','.'))
            if(val_num > 100) event.target.value = '100'
            if(val_num < 0||val=='') event.target.value = '0'
            this.adjast_input_width()
        },
        adjast_input_width(){
            let input = this.$refs.imput_pecent
            if(!input) return false
            input.style.width = ((input.value.length-1) * 10 + 15) + 'px'
        },
        edit_value(event){
            let val = event.target.value
            val = Number(val.replace(',','.'))
            if(!val) val = '0'
            event.target.value = val.toLocaleString('DE-de')
            this.$emit('edit_value', val)
            EventBus.emit('edit:input',{ parent_item:this.search_data.id_parent , id_item: this.search_data.id , value:val})
            this.adjast_input_width()
        }
    }
}
</script>

<style scoped>
    .wrap_element{
        display: flex;
    }
    .percent{
        display: flex;
        justify-content: center;
        align-items: baseline;
        gap: 0px;
    }
    input{
        width: 80px!important;
        text-align: right;
        font-family:inherit;
        color: inherit;
        font-size: inherit;
    }

    .sumbol{
        font-size: v-bind(font_size_sumbol);
    }

    .edit{
        position: relative;
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        padding-right: 15px;
        z-index: 100;
    }

    .panel{
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