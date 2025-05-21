<template>
    <div class="wrap honorar_detals" >
        <div class="list">
            <div class="detal-item">
                <div class="title">{{ text.Name }}</div>
                <div class="funding">{{ nameFunding }}</div>
                <div class="min_fee">{{ text.Honorar_min }}</div>
                <div class="max_fee">{{ text.Honorar_max }}</div>
            </div>
            <div class="detal-item" v-if="!!data.up">
                <div class="title">{{ text.Table_Value_Top }}</div>
                <div class="funding"><Price font_size_unit="18px" :value ="data.up.funding" :typeCurrancy="typeValue"/></div>
                <div class="min_fee"><Price font_size_unit="18px" :value ="data.up.min_fee" /></div>
                <div class="max_fee"><Price font_size_unit="18px" :value ="data.up.max_fee" /></div>
            </div>
            <div class="detal-item" v-if="!!data.current">
                <div class="title">{{ text.Interpolation }}</div>
                <div class="funding"><Price font_size_unit="18px" :value ="data.current.funding"  :typeCurrancy="typeValue" /></div>
                <div class="min_fee"><Price font_size_unit="18px" :value ="data.current.min_fee" /></div>
                <div class="max_fee"><Price font_size_unit="18px" :value ="data.current.max_fee" /></div>
            </div>
            <div class="detal-item" v-if="!!data.low">
                <div class="title">{{ text.Table_Value_Bottom }}</div>
                <div class="funding"><Price font_size_unit="18px" :value ="data.low.funding"  :typeCurrancy="typeValue" /></div>
                <div class="min_fee"><Price font_size_unit="18px" :value ="data.low.min_fee" /></div>
                <div class="max_fee"><Price font_size_unit="18px" :value ="data.low.max_fee" /></div>
            </div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export  default{
    name: 'HonorarDetal_calc',
    data(){
        return{
            text:{
                Name: text.Calc.Honorar_detals.Name,
                Honorar_min: text.Calc.Honorar_detals.Honorar_min,
                Honorar_max: text.Calc.Honorar_detals.Honorar_max,
                Table_Value_Top: text.Calc.Honorar_detals.Table_Value_Top,
                Interpolation: text.Calc.Honorar_detals.Interpolation,
                Table_Value_Bottom: text.Calc.Honorar_detals.Table_Value_Bottom,
            }
        }
    },
    computed:{
        nameFunding(){
            if(this.typeValue == 'Hektar'){
                return 'Fläche'
            }else{
                return 'Anrechenbare Kosten'
            }
        }
    },
    props:{
        data: {
            type:Object,
            default:{}
        },
        typeValue:String,
    }
}
</script>

<style scoped>
.wrap{
    display: flex;
    background-color: #fff;
    margin-left: 55px;
    margin-bottom: 15px;
}
.wrap::before{
    position: relative;
    left: -26px;
    top: -15px;
    content: "";
    border-left: solid 1px #E4E4E4;
    box-shadow: 0px 40px 0px #000;
    margin-bottom: 35px;
}
.list{
    width: 100%;
}
.detal-item{
    height: 30px;
    display: flex;
    justify-content: flex-start;
    color: #8E8E8E;
    font-family:'Raleway-Light';
    font-size: 18px;
    align-items: baseline;
}
.title{
    width: 250px;
}
.funding, .min_fee, .max_fee{
    width: 250px;
}
</style>