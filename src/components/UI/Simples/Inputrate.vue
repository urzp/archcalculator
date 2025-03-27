<template>
    <div class="imputrate">
        <div  v-if="!edit" class="value" @click="begin_edit">{{ !value?'0':Number(value).toLocaleString("de-DE") }}</div>
        <input v-if="edit" ref="thisinput" type="number" min="0" 
            :value = "value" 
            @change="event => update(event.target.value)" 
            @blur="edit = false"
        />
        <!-- @blur="edit = false" -->
        <div class="type" @click="openinglist()">{{ type }}</div>
        <div class="wrap_select_list">
            <Select_List :data="data_list" no_toggle :prop_open="open_list" @selected="value=>{select_type(value)}"></Select_List>
        </div>
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
            open_list:false,
            data_list:{
                list:[
                    {id:1, value:'%'}, 
                    {id:2, value:'€/h'},
                    {id:3, value:'km'}, 
                    {id:4, value:'m2'}, 
                    {id:5, value:'Stk'}, 
                ],
            }
        }
    },
    props:{
        value:{
            type:[String, Number],
            default:''
        },
        type:{
            type:String,
            default:'%',
        },
        width:{
            type:String,
            default: '150px',
        }
    },
    emits:['submit', 'select_type'],
    methods:{
        begin_edit(){
            this.edit = true
            setTimeout( ()=>{ this.$refs.thisinput.focus() }, 100);
            EventBus.emit('fucus:input', this.id)
        },
        update(value){
            this.edit = false
            value = parseFloat(value)
            console.log(value)
            this.$emit('submit', value)
        },
        openinglist(){
            this.open_list=true
            setTimeout(()=>{this.open_list=false}, 300)
        },
        select_type(value){
            value = value.value
            this.$emit('select_type', value)
        }
    }
}

</script>


<style scoped>
    .value, .type{
        font-size: 18px;
        font-family: 'DroidSans';
        color: #464646;
    }
    .type{
        cursor: pointer;
        width: 30px;
        margin-left: 5px;
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
    .wrap_select_list{
        margin: 0px;
    }
</style>