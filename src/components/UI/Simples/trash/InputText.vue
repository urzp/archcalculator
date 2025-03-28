<template>
    <div v-show="!edit" class="value" @click="begin_edit">{{ !value?'-':value }}</div>
    <div class="wrap-edit" v-show="edit">
        <input  
            ref="thisinput" 
            type="text"  
            :value="value"
            @change="event => submit_event(event)"
            @blur="edit = false"
            @keydown="handleKeydown"
            >
        <div class="panel">
            <CloseButton class="button" width="35px" height="28px" @click="edit=false"/>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'InputText',
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
        focus:{
            type:Boolean,
            default: false,
        },
        
    },
    watch:{
        focus:{
            handler(n_v, o_v){ if(n_v&&!o_v) this.begin_edit() }
        }
    },
    emits:['submit_event', 'presstab'],
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
        handleKeydown(event) {
            if (event.key === 'Tab') {
                event.preventDefault(); 
                this.$emit('presstab');
            }
        }
    }
}
</script>

<style scoped>
    .value{
        height: 30px;
        /* width: v-bind(width); */
        min-width: 50px;
        font-family: 'Raleway-Light';
        font-size: 18px;

    }
    .wrap-edit{
        display: flex;
        column-gap: 10px;
    }
    input{
        height: 30px;
        width: v-bind(width);
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        margin-left: -15px;
        font-size: 18px;
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .panel{
        position: relative;
    }
    .button{
        position: absolute;
    }

</style>