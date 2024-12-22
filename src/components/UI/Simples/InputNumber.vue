<template>
    <div v-if="!edit" class="value" @click="begin_edit">{{ floatRender(value) }}{{ paramSymb }}</div>
    <div class="wrap-edit" v-if="edit" @click.stop>
        <input  
            ref="thisinput" 
            type="text"  
            :value="value"
            @change="event => edit_value(event)">
        <div class="panel" >
            <UpdateBtn v-if="!noUpdate" class="button" width="35px" height="28px" @click="set_default()"/>
        </div>
    </div>
    <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { intToFloat } from '@/servis/functions'
export default{
    name: 'InputNumber',
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
        paramSymb:{
            type: String,
            default:''
        },
        float:{
            type:[Number,String], 
            default: ''
        },
        noUpdate:{
            type:Boolean,
            default: false,
        }
    },
    emits:['editValue', 'setDefault'],
    methods:{
        floatRender(){
            if(this.float === '') return this.value
            return intToFloat(Number(this.value), this.float)
        },
        begin_edit(){
            this.edit = true
            setTimeout( ()=>{ this.$refs.thisinput.focus() }, 300);
            EventBus.emit('fucus:input', this.id)
        },
        edit_value(event){
            this.edit = false
            let val = event.target.value
            this.$refs.thisinput.value = ''
            this.$emit('editValue', val)
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
        text-align: inherit;
    }
    .wrap-edit{
        position: relative;
        display: flex;
        justify-content: center;
        column-gap: 10px;
        z-index: 100;
    }
    input{
        height: 28px;
        width: 60px;
        border-radius: 5px;
        background-color: #ebebeb;
        font-size: inherit;
        font-family: inherit;
        color: inherit;
        text-align: center;
    }

    .panel{
        width: 0;
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