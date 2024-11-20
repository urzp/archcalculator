<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="delete"><DeleteButton icon_cross no_border :heigth="'32px'" @click="deleteItem()"/></div>
            <input class="title" :placeholder="'Leistung eingeben'" :value="title" @change="event => updateUserTitle(event.target.value)"/>
            <div class="wrap_figures">
                <div class="wrap_imputs">
                    <div class="imputrate"><input type="number" min="0" :value = "rate" @change="event => updateRate(event.target.value)" /></div>
                    <Price input_type :value ="price_rate" @edit_price="newValue=>updatePriceRate(newValue)" input_width="60px" font_size_unit="18px" />
                </div>
                <div class="price" ><Price :value ="value" /></div>
            </div>
        </div>
    </div>
</template>

<script>
export  default{
    name: 'ItemExtraCost',
    async mounted(){
    },
    data(){
        return{

        }
    },
    props:{
        id:[Number,String],
        title:String,
        rate:Number,
        price_rate:Number,
    },
    emits:['updateItem', 'deleteItem'],
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
    .wrap_imputs{
        display: flex;
        align-items: baseline;
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