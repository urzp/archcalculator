<template>
    <div v-if="!edit" class="value" @click="begin_edit">{{ valueRender }}</div>
    <div class="wrap-edit" v-if="edit" @click.stop>
        <input  
            ref="thisinput" 
            type="text"  
            :value="valueRender"
            @change="event => submit_event(event)">
        <div class="panel">
            <UpdateBtn v-if="!noUpdate" class="button" width="35px" height="28px" @click="set_default()"/>
        </div>
    </div>
    <div v-if="edit" @click.stop="edit=false" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { intToFloat } from '@/servis/functions'
export default{
    name: 'ImputHours_Bill',
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
    computed:{
        width_panel(){
            let result  = '35px'
            if(this.noUpdate) result = '0'
            return result
        }, 
        valueRender(){
            return intToFloat(Number(this.value), 2)
        }
    },
    props:{
        value:{
            type:[String, Number],
            default: 0
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
        text-align: inherit;
    }
    .wrap-edit{
        position: relative;
        display: flex;
        column-gap: 10px;
        z-index: 100;
    }
    input{
        height: 30px;
        width: 100%;
        border-radius: 5px;
        background-color: #ebebeb;
        padding-left: 15px;
        font-size: inherit;
        font-family: inherit;
        color: inherit;
        text-align: center;
    }

    .panel{
        width: v-bind(width_panel);
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