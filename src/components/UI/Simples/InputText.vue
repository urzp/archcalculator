<template>
    <div class="wrap-edit" >
        <input  
            ref="thisinput" 
            type="text"  
            :value="value"
            @input="event => input_event(event)"
            @change="event => submit_event(event)"
            >
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
        autuClear:{
            type:Boolean,
            default: true,
        }
    },
    emits:['input_event', 'submit_event', 'presstab'],
    methods:{
        submit_event(event){
            this.edit = false
            let val = event.target.value
            if(this.autuClear) this.$refs.thisinput.value = ''
            this.$emit('submit_event', val)
        },
        input_event(event){
            let val = event.target.value
            this.$emit('input_event', val)
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
        padding-left: 15px;
        margin-left: -15px;
        font-size: inherit;
        font-family: 'Raleway-Light';
        color: #464646;
    }

    input:focus{
        background-color: #ebebeb;
    }

    .panel{
        position: relative;
    }
    .button{
        position: absolute;
    }

</style>