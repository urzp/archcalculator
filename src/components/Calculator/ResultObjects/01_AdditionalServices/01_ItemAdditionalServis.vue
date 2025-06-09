<template>
    <div class="item-Part-obj AdditionalServis" >
        <div  class="main_row" >
            <div class="delete"><DeleteButton icon_cross no_border :heigth="'32px'" @click="deleteItem()"/></div>
            <input class="title" :placeholder="text.Enter_performance" :value="title" @change="event => updateUserTitle(event.target.value)"/>
            <div class="wrap_figures">
                <div class="wrap_colum wrap_colum_1">
                    <!-- <div class="imputrate"><input type="number" min="0" :value = "rate" @change="event => updaterate(event.target.value)" /> <div class="typeSumbol">h</div></div> -->
                    <Inputrate :value = "rate" :type="type_rate" @submit="value=>updateRate(value)" @select_type="value=>updateType(value)" width="150px"></Inputrate>
                </div>
                <div class="wrap_colum wrap_colum_2">
                    <Price input_type :value ="price_rate" @edit_price="newValue=>updatePricerate(newValue)" input_width="60px" font_size_unit="18px" :typeCurrancy="currency_type_rate"/>
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
    name: 'ItemAdditionalServis',
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
        price_rate:[Number,String],
        type_rate:{
            type:String,
            default:'h',
        },
        total_objects: Number,
    },
    emits:['updateItem', 'deleteItem'],
    computed:{
        value(){
            let value = 0
            if(this.type_rate=='%'){ value = (Number(this.rate)/100) * Number(this.price_rate) } else { value = Number(this.rate) * Number(this.price_rate) }
            this.$emit('updateItem', {value, id:this.id, name:'summ'}) 
            return value
        },
        currency_type_rate(){
            if(this.type_rate=="%") return'€ '
            return '€/'+this.type_rate
        }
    },
    methods:{
        updateUserTitle(value){
            this.$emit('updateItem', {value, id:this.id, name:'title'})
        },
        updateRate(value){
            this.$emit('updateItem', {value, id:this.id, name:'rate'})
        },   
        updatePricerate(value){
            this.$emit('updateItem', {value, id:this.id, name:'price_rate'})
        },   
        deleteItem(){
            this.$emit('deleteItem',this.id)
        },
        updateType(value){
            if(value=="%"){ this.updatePricerate(this.total_objects) }
            value = {id:this.id, name:'type_rate', value}
            this.$emit('updateItem',value)
        },
        
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
        width: 45px!important;
        text-align: right;
        font-family: 'Comfortaa-Regular';
        font-size: 18px;
        color:#464646;
    }
    .typeSumbol{
        font-family: 'Comfortaa-Regular';
        font-size: 18px;
        color:#464646;   
        width: 30px;
        margin-left: 5px;  
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