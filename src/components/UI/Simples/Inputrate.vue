<template>
    <div class="imputrate">
        <div  v-if="!edit" class="value" @click="begin_edit">{{ !value?'-':Number(value).toLocaleString("de-DE") }}</div>
        <template v-if="edit">
            <input ref="thisinput" type="number" min="0" 
            :value = "value" 
            @change="event => update(event.target.value)" 
            @blur="edit = false"
            />
        </template>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
    name: 'Inputrate',
    mounted(){
        this.id = this.$.uid
        EventBus.on('fucus:input', value =>{ if(this.id!=value) this.edit = false })
    },
    data(){
        return{
            id:null,
            edit:false,
        }
    },
    props:{
        value:{
            type:[String, Number],
            default:''
        },
        width:{
            type:String,
            default: '150px',
        }
    },
    emits:['submit'],
    methods:{
        begin_edit(){
            this.edit = true
            setTimeout( ()=>{ this.$refs.thisinput.focus() }, 300);
            EventBus.emit('fucus:input', this.id)
        },
        update(value){
            this.edit = false
            value = parseFloat(value)
            console.log(value)
            this.$emit('submit', value)
        }
    }
}

</script>


<style scoped>
    .value{
        font-size: 18px;
        font-family: 'DroidSans';
        color: #464646;
    }
    input{
        height: 28px;
        width: v-bind(width);
        border-radius: 5px;
        padding-left: 15px;
        font-size: 18px;
        font-family: 'DroidSans';
        color: #464646;
        text-align: right;
    }
</style>