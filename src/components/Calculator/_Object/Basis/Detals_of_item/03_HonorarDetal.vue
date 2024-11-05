<template>
    <div class="wrap" >
        <div class="list">
            <div class="detal-item">
                <div class="title">Name</div>
                <div class="funding">Anrechenbare Kosten</div>
                <div class="min_fee">Honorar von</div>
                <div class="max_fee">Honorar bis</div>
            </div>
            <div class="detal-item" v-if="!!data.up">
                <div class="title">Tabellenwert Oben</div>
                <div class="funding"><Price font_size_unit="18px" :value ="data.up.funding" /></div>
                <div class="min_fee"><Price font_size_unit="18px" :value ="data.up.min_fee" /></div>
                <div class="max_fee"><Price font_size_unit="18px" :value ="data.up.max_fee" /></div>
            </div>
            <div class="detal-item" v-if="!!data.current">
                <div class="title">Interpolation</div>
                <div class="funding"><Price font_size_unit="18px" :value ="data.current.funding" /></div>
                <div class="min_fee"><Price font_size_unit="18px" :value ="data.current.min_fee" /></div>
                <div class="max_fee"><Price font_size_unit="18px" :value ="data.current.max_fee" /></div>
            </div>
            <div class="detal-item" v-if="!!data.low">
                <div class="title">Tabellenwert Unten</div>
                <div class="funding"><Price font_size_unit="18px" :value ="data.low.funding" /></div>
                <div class="min_fee"><Price font_size_unit="18px" :value ="data.low.min_fee" /></div>
                <div class="max_fee"><Price font_size_unit="18px" :value ="data.low.max_fee" /></div>
            </div>
        </div>
    </div>
</template>

<script>
import Price from '@/components/UI/Price.vue';
import { EventBus } from '@/servis/EventBus'
export  default{
    name: 'HonorarDetal_calc',
    props:{
        data: {
            type:Object,
            default:{}
        }
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
}
.title{
    width: 250px;
}
.funding, .min_fee, .max_fee{
    width: 250px;
}
</style>