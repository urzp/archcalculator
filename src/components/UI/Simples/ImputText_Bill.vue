<template>
    <div v-if="!edit" class="value" @click="begin_edit">{{ !value?'-':value }}</div>
    <div class="wrap-edit" v-if="edit" @click.stop>
        <input  
            ref="thisinput" 
            type="text"  
            :value="value"
            @change="event => submit_event(event)">
        <div class="panel">
            <UpdateBtn v-if="!noUpdate" class="button" width="35px" height="28px" @click="set_default()"/>
        </div>
    </div>
    <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'InputText_Bill',
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
        }
    }
}
</script>

<style scoped>
    .value{
        height: 30px;
        /* width: v-bind(width); */
        min-width: 50px;
        font-family: inherit;
        font-size: inherit;
        color: inherit;

    }
    .wrap-edit{
        position: relative;
        display: flex;
        column-gap: 10px;
        z-index: 100;
    }
    input{
        height: 28px;
        width: v-bind(width);
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        font-size: inherit;
        font-family: inherit;
        color: inherit;
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