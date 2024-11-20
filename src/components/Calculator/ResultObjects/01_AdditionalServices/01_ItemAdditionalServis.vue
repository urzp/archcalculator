<template>
    <div class="item-Part-obj" >
        <div  class="main_row" >
            <div class="delete"><DeleteButton icon_cross no_border :heigth="'32px'" @click="deleteItem()"/></div>
            <input class="title" :placeholder="'Leistung eingeben'" :value="title" @change="event => updateUserTitle(event.target.value)"/>
            <div class="wrap_figures">
                <div class="wrap_imputs">
                    <div class="imputHours"><input type="number" min="0" :value = "hours" @change="event => updateHours(event.target.value)" /> <div class="typeSumbol">h</div></div>
                    <Price input_type :value ="price_hours" @edit_price="newValue=>updatePriceHours(newValue)" input_width="60px" font_size_unit="18px" :typeCurrancy="'€/h'"/>
                </div>
                <div class="price" ><Price :value ="value" /></div>
            </div>
        </div>
    </div>
</template>

<script>
export  default{
    name: 'ItemAdditionalServis',
    async mounted(){
    },
    data(){
        return{

        }
    },
    props:{
        id:[Number,String],
        title:String,
        hours:Number,
        price_hours:Number,
    },
    emits:['updateItem', 'deleteItem'],
    computed:{
        value(){
            return Number(this.hours) * Number(this.price_hours)
        },
    },
    methods:{
        updateUserTitle(value){
            this.$emit('updateItem', {value, id:this.id, name:'title'})
        },
        updateHours(value){
            this.$emit('updateItem', {value, id:this.id, name:'hours'})
        },   
        updatePriceHours(value){
            this.$emit('updateItem', {value, id:this.id, name:'price_hours'})
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
    .imputHours{
        display: flex;
        align-items: baseline;
    }
    .imputHours input{
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