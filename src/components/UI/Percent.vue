<template>
    <div class="percent">
        <div v-if="!input_type" class="value">{{value}}</div>
        <input v-else ref="imput_pecent" type="text"  class="value" :value="value.toLocaleString('DE-de')" @change="event => edit_value(event)" @input="event => { validate(event) }"/>
        <div class="sumbol">%</div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export  default{
    name: 'Percent',
    mounted(){
        this.adjast_input_width()
    },  
    props:{
        value: Number,
        name_value: String,
        input_type:{ 
            type: Boolean,
            default: false,
        },
    }, 
    emits:['edit_value'],
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
            input.style.width = ((input.value.length-1) * 10 + 15) + 'px'
        },
        edit_value(event){
            let val = event.target.value
            val = Number(val.replace(',','.'))
            if(!val) val = '0'
            event.target.value = val.toLocaleString('DE-de')
            this.$emit('edit_value', val)
            EventBus.emit('edit:input',{ name_value: this.name_value , value:val})
            this.adjast_input_width()
        }
    }
}
</script>

<style scoped>
    .percent{
        font-family: 'Comfortaa-Regular';
        display: flex;
        align-items: baseline;
        gap: 0px;
    }
    .value{
        font-size: 18px;
    }
    .sumbol{
        font-size: 16px;
    }
    input{
        width: 30px;
        text-align: left;
        font-family:inherit;
        color: inherit;
    }
</style>