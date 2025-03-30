<template>
    <div class="wrap-edit" @click.stop>
        <textarea  
            ref="thisinput" 
            rows="3"
            type="text"  
            :value="value"
            @input="event => autosize(event)"
            @change="event => submit_event(event)"
            @focus="edit=true"
            @blur="edit=false"
            ></textarea>
        <div v-if="edit" class="panel">
            <UpdateBtn v-if="!noUpdate"  class="button" width="35px" height="28px" @click="set_default()"/>
        </div>
    </div>
    <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { checkLock } from '@/servis/projectData';
export default{
    name: 'ImputTextMLine_Bill',
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
        },
        noUpdate:{
            type:Boolean,
            default: false,
        }
    },
    emits:['submit_event', 'setDefault'],
    methods:{
        begin_edit(){
            if(checkLock()) return false
            this.edit = true
            setTimeout( ()=>{ this.$refs.thisinput.focus() }, 300);
            EventBus.emit('fucus:input', this.id)
        },
        submit_event(event){
            this.edit = false
            let val = event.target.value
            this.$refs.thisinput.value = ''
            this.$emit('submit_event', val)
            
        },
        set_default(){
            this.$emit('setDefault')
        },
        autosize(event){
            let textarea = event.target
            textarea.style.height = '1px';
            textarea.style.height = textarea.scrollHeight + 'px'
        }
    }
}
</script>

<style scoped>
    .value{
        width: v-bind(width);
        min-width: 50px;
        font-family: 'Raleway-Light';
        font-size: inherit;

    }
    .wrap-edit{
        display: flex;
        column-gap: 10px;
    }
    textarea{
        width: v-bind(width);
        border-radius: 5px;
        padding-left: 15px;
        margin-left: -15px;
        border: none;
        resize: none;
        font-size: inherit;
        font-family: 'Raleway-Light';
        line-height: 26px;
        color: #464646;
    }

    textarea:focus{
        background-color: #ebebeb;
    }

    .panel{
        position: relative;
    }
    .button{
        position: absolute;
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