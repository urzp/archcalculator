<template>
    <div v-if="!!cardData" class="wrap_card">
        <div class="title_card">{{ title }}</div>
        <div class="content">
            <div class="price_data">
                <div class="price">
                    <div class="price_value">{{ price_value }}</div><div class="curency">€</div>
                </div>
                <div class="price_period">{{ price_period }}</div>
            </div>
            <div class="list_servis">
                <div v-for="item in list_sevices" :key="item.id" class="item_servis" :class="item.text_align"><div class="symbol_item">●</div> {{ item.text }}</div>
            </div>
        </div>
        <div v-if="show_button" class="button" @click="gotoStirpe()">
            <div class="text">{{ cardData.button.label }}</div>
        </div>
        <div v-if="show_button" class="ust">*zzgl. USt., Berechnung beim Abschluss des Kaufs</div>
    </div>
</template>

<script>
import { user } from '@/servis/globalValues.js'
export default{
    name: 'TarifCard',
    props:{
        cardData: {
            type: Object,
            default: null,
        }
    },
    computed:{
        title(){
            let result = '-';
            if(!!this.cardData.price&&!!this.cardData.title){ result = this.cardData.title }
            return result
        },
        price_value(){
            let result = '-';
            if(!!this.cardData.price&&this.cardData.price.value!==null){ result = this.cardData.price.value }
            return result
        },
        curency(){
            let result = '-';
            if(!!this.cardData.price&&this.cardData.price.curency!==null){ result = this.cardData.price.curency }
            return result
        },
        price_period(){
            let result = '-';
            if(!!this.cardData.price_period){ result = this.cardData.price_period }
            return result
        },
        list_sevices(){
            let result = []
            if(!!this.cardData.list_sevices) result = this.cardData.list_sevices
            return result
        },
        show_button(){
            let result = false
            if(!!this.cardData.button&&!!this.cardData.button.label) result = true
            return result
        },
        link(){
            let result = "#"
            if(!!this.cardData.button&&!!this.cardData.button.link) result = this.cardData.button.link
            return result
        }
    },
    methods:{
        async gotoStirpe(){
            let user_data = '?client_reference_id=' + user.id
            let code = (await apiData({typeData:'begin_subscribe'})).data
            user_data = user_data + "_" + code
            this.$router.open(this.link + user_data)
        }
    }
}
</script>

<style scoped>
    .wrap_card{
        width: 450px;
        height: 600px;
        padding: 30px;
        display: flex;
        flex-direction: column;
        border-radius: 15px;
        box-shadow: 0px 0px 15px #00000052;

    }
    .title_card{
        text-align: center;
        font-family: 'Raleway-Light';
        font-size: 32px;
        color: #EBAA6C;
        border-bottom: 1px solid #DEDEDE;
    }
    .content{
        flex-grow: 1;
    }
    .price_data{
        padding: 20px 0;
        font-family: 'Raleway-Light';
        font-size: 24px;
    }
    .price{
        margin-bottom: -10px;
        display: flex;
        align-items: baseline;
        justify-content: center;
        column-gap: 10px;
    }
    .price_value{
        font-size: 32px;
    }
    .price_period{
       text-align: center; 
    }
    .list_servis{
        font-family: 'Comfortaa-Regular';
        font-size: 14px;
        color: #828282;
    }
    .symbol_item{
        margin-right: 10px;
        color: #aeaeae;
    }
    .item_servis.center{
        text-align: center;
    }

    .item_servis{
        display: flex;
        margin-bottom: 10px;
    }

    .button{
        height: 40px;
        width: 100%;
        font-family: 'Comfortaa-Light';
        font-size: 18px;
        color:#5C5C5C;
        border: 1px solid #C4C4C4;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    .ust{
        margin-top: 20px;
        font-size: 12px;
        color: #828282;
    }

    @media (max-width: 680px){
        .wrap_card{
            width: 400px;
        }
        
    }


</style>