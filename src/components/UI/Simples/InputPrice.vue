<template>
    <div  v-if="!edit" class="value" @click="begin_edit">{{ !value?'-':Number(value).toLocaleString("de-DE") }}</div>
    <template v-if="edit">
        <input  ref="thisinput" type="text"  
        :value="value"
        @change="event => submit_event(event)"
        @keyup.ctrl.v="console.log('copy-past')">
        <CloseButton width="35px" height="28px" @click="edit=false" />
    </template>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'InputPrice',
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
            type:String,
            default:''
        },
        width:{
            type:String,
            default: '150px',
        }
    },
    emits:['submit_event'],
    methods:{
        begin_edit(){
            this.edit = true
            setTimeout( ()=>{ this.$refs.thisinput.focus() }, 300);
            EventBus.emit('fucus:input', this.id)
        },
        submit_event(event){
            this.edit = false
            let val = event.target.value
            this.$refs.thisinput.value = ''
            this.$emit('submit_event', val)
            
        }
    }
}
</script>

<style scoped>
    .value{
        font-size: 18px;
        font-family: 'Raleway-Light';
        color: #464646;
    }
    input{
        height: 28px;
        width: v-bind(width);
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        font-size: 18px;
        font-family: 'Raleway-Light';
        color: #464646;
    }
</style>