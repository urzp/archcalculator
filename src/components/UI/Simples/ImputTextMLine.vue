<template>
    <div v-if="!edit" class="value" @click="begin_edit">{{ !value?'-':value }}</div>
    <div class="wrap-edit" v-if="edit">
        <textarea  
            ref="thisinput" 
            rows="3"
            type="text"  
            :value="value"
            @change="event => submit_event(event)"></textarea>
        <div class="panel">
            <CloseButton class="button" width="35px" height="28px" @click="edit=false"/>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'ImputTextMLine',
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
        width: v-bind(width);
        min-width: 50px;
        font-family: 'Raleway-Light';
        font-size: 18px;

    }
    .wrap-edit{
        display: flex;
        column-gap: 10px;
    }
    textarea{
        width: v-bind(width);
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        border: none;
        resize: none;
        font-size: 18px;
        font-family: 'Raleway-Light';
        line-height: 26px;
        color: #464646;
    }

    .panel{
        position: relative;
    }
    .button{
        position: absolute;
    }

</style>