<template>
    <div class="percent"  @click="checkLock()">
        <div v-if="!input_type||isLocked" class="value">{{value}}</div>
        <input v-else ref="imput_pecent" type="text"  class="value" :value="value.toLocaleString('DE-de')" @change="event => edit_value(event)" @input="event => { validate(event) }"/>
        <div class="sumbol">%</div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { checkLock, Project } from '@/servis/projectData';
export  default{
    name: 'Percent',
    mounted(){
        this.adjast_input_width()
    },  
    computed:{
        isLocked(){
            if(!!Project&&!!Project.project&&Project.project.locked=='1') return true
            return false
        }
    },
    props:{
        value: [String,Number],
        input_type:{ 
            type: Boolean,
            default: false,
        },
        search_data:{
            typeof:Object,
            default:{id_parent:'0', id:'0'}
        },
        font_size_value:{
            type:String,
            default: '18px',            
        },
        font_size_sumbol:{
            type:String,
            default: '16px',            
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
        },
        checkLock(){
            checkLock()
        }
    }
}
</script>

<style scoped>
    .percent{
        width: 100%;
        font-family: 'DroidSans';
        display: flex;
        align-items: baseline;
        justify-content: flex-end;
        gap: 0px;
    }
    .value{
        font-size: v-bind(font_size_value);
    }
    .sumbol{
        width: 30px;
        margin-left: 5px;
        font-size: v-bind(font_size_sumbol);
    }
    input{
        width: 45px!important;
        text-align: right;
        font-family:'DroidSans';
        color: inherit;
    }
</style>