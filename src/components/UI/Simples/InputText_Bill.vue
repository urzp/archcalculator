<template>
    <div class="wrap-edit" @click.stop>
        <input  v-if="!isShowProject"
            ref="thisinput" 
            type="text"  
            :value="!value?'-':value"
            @change="event => submit_event(event)"
            @focus="edit=true"
            @blur="edit=false"
        >
        <div v-else>{{ !value?'-':value }}</div>
        <div v-if="edit&&!noUpdate&&!isShowProject" class="panel">
            <UpdateBtn v-if="!noUpdate" class="button" width="35px" height="28px" @click="set_default()"/>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { checkLock } from '@/servis/projectData';
export default{
    name: 'InputText_Bill',
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
        isShowProject(){
            let result = false
            if(!!this.$route.query&&!!this.$route.query.bill) result = true
            return result
        },
    },
    props:{
        value:{
            type:[String, Number],
            default:''
        },
        width:{
            type:String,
            default: '150px',
        },
        alight_edit:{
            type:String,
            default: 'left',            
        },
        noUpdate:{
            type:Boolean,
            default: false,
        },
        bg_input_color:{
            type:String,
            default:'#ebebeb',
        },
        ajast_top:{
            type:String,
            default:'0px',
        }
    },
    emits:['submit_event', 'setDefault'],
    methods:{
        submit_event(event){
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
        text-align: inherit;
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
        padding-right: 15px;
        margin-right: -15px;
        font-size: inherit;
        font-family: inherit;
        color: inherit;
        text-align: v-bind(alight_edit);
    }

    input:focus{
        background-color: v-bind(bg_input_color);
    }

    .panel{
        width: v-bind(width_panel);
        position: relative;
        left: 10px;
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