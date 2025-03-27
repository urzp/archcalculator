<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="delete"><DeleteButton icon_cross no_border :heigth="'32px'" @click="deleteItem()"/></div>
            <input class="title" :placeholder="text.Enter_performance" :value="title" @change="event => updateUserTitle(event.target.value)"/>
            <div class="wrap_figures">
                <div class="wrap_colum wrap_colum_1">
                    <Inputrate :value = "rate" :type="type_rate" @submit="value=>updateRate(value)" @select_type="value=>updateType(value)" width="150px"></Inputrate>
                </div>
                <div class="wrap_colum wrap_colum_2">
                    <Price input_type :value ="price_rate" @edit_price="newValue=>updatePriceRate(newValue)" input_width="100%" font_size_unit="18px" />
                </div>
                <div class="wrap_colum wrap_colum_3">
                    <div class="price" ><Price :value ="value" /></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export  default{
    name: 'ItemExtraCost',
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
        id:[Number,String],
        title:String,
        rate:[Number,String],
        type_rate:String,
        price_rate:[Number,String],
    },
    emits:['updateItem'],
    computed:{
        value(){
            return Number(this.rate) * Number(this.price_rate)
        },
    },
    methods:{
        updateUserTitle(value){
            this.$emit('updateItem', {value, id:this.id, name:'title'})
        },
        updateRate(value){
            this.$emit('updateItem', {value, id:this.id, name:'rate'})
        },   
        updatePriceRate(value){
            this.$emit('updateItem', {value, id:this.id, name:'price_rate'})
        },   
        deleteItem(){
            this.$emit('deleteItem',this.id)
        },
        updateType(value){
            value = {id:this.id, name:'type_rate', value}
            this.$emit('updateItem',value)
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
        width: 60%;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .wrap_figures{
        width: 40%;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .wrap_colum{
        display: flex;
        align-items: baseline;
        justify-content: flex-end;
    }
    .wrap_colum_1{
        width: 25%;
    }
    .wrap_colum_2{
        width: 35%;
    }
    .wrap_colum_3{
        width: 40%;
    }
    .imputrate{
        display: flex;
        align-items: baseline;
    }
    .imputrate input{
        text-align: right;
        font-family: 'Comfortaa-Regular';
        font-size: 18px;
        color:#464646;
    }
    .typeSumbol{
        font-family: 'Comfortaa-Regular';
        font-size: 18px;
        color:#464646;     
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