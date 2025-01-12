<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="delete"><DeleteButton icon_cross no_border :heigth="'32px'" @click="deleteItem()"/></div>
            <input class="title" :placeholder="text.Enter_performance" :value="title" @change="event => updateUserTitle(event.target.value)"/>
            <div class="wrap_figures">
                <Percent input_type :value = "percent" @edit_value="value=>updatePercent(value)"/>
                <div class="price" ><Price :value ="value" /></div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export  default{
    name: 'ItemSpetialServis',
    async mounted(){
    },
    data(){
        return{
            text:{
                Enter_performance: text.Calc.Enter_performance, 
            }
        }
    },
    props:{
        id:[String,Number],
        title:String,
        honorar:Number,
        percent:Number,
    },
    emits:['updateItem', 'deleteItem'],
    computed:{
        value(){
            return Number(this.honorar) * Number(this.percent)/100
        },
    },
    methods:{
        updateUserTitle(value){
            this.$emit('updateItem', {value, id:this.id, name:'title'})
        },
        updatePercent(value){
            this.$emit('updateItem', {value, id:this.id, name:'percent'})
        },   
        deleteItem(){
            this.$emit('deleteItem',this.id)
        }
        
    }
}

</script>

<style scoped>
    .main_row{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
    }   
    .title{
        margin-left: 55px;
        width: 700px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .wrap_figures{
        width: 300px;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .price{
        color:#838383;
    }
    .detals{
        position: relative;
    }
    .detals .icon{
        display: block;
        position: absolute;
        border-radius: 50%;
        height: 8px;
        width: 8px;
        background-color: #C0C0C0;
        content: " ";
        left: 25px;
        top: 13px;
        cursor: pointer;
    }

    .detal-list {
        background-color: #fff;
    }

    .delete{
        position: absolute;
        visibility: hidden;
    }
    .main_row:hover .delete{
        visibility:visible;
    }
</style>