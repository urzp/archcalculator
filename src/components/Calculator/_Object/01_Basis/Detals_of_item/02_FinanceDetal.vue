<template>
    <div class="wrap" :class="{active:useDetals}" @click="this.$emit('useDetals')">
        <div class="list">
            <div class="detal-item" v-for="item in list" :key="item.id">
                <input class="title" :placeholder="item.name" :value="item.userTitle" @change="event => updateUserTitle(item.id, event.target.value)"/>
                <div class="value-wrap">
                    <Price input_type font_size_unit="18px" :value="item.value" @edit_price="val=>updatePrice(item.id, val)" :typeCurrancy="typeCurrancy"/>
                </div>
            </div>
            <div v-if="has_400_Bauwerk" class="detal-item">$
                <div class="title">100-800 Summe</div>
                <div class="value-wrap">
                    <Price font_size_unit="18px" :value="summ_100_800" />
                </div>
            </div>
            <div v-if="has_400_Bauwerk"  class="kg400_Bauwerk">
                <div class="row header">
                    <div class="name_item"></div>
                    <div class="imput_calc">Hilfswert</div>
                    <div class="percent"></div>
                    <div class="output_calc">Anrechenbar</div>
                    <div class="total_calc"></div>
                </div>
                <div class="row">
                    <div class="name_item">hiervon sonstige anrechenbare Kosten</div>
                    <div class="imput_calc"></div>
                    <div class="percent"></div>
                    <div class="output_calc"><Price font_size_unit="16px" :value="summ_other"/></div>
                    <div class="total_calc"></div>             
                </div>
                <div class="row">
                    <div class="name_item">hiervon bedingt anrechenbare Kosten</div>
                    <div class="imput_calc"><Price font_size_unit="16px" :value="kg400"/></div>
                    <div class="percent"></div>
                    <div class="output_calc"></div>
                    <div class="total_calc"></div>             
                </div>
                <div class="row">
                    <div class="name_item left_gap">{{ `hiervon zu 100% anrechenbar (25% von ${summ_other}€)` }}</div>
                    <div class="imput_calc"><Price font_size_unit="16px" :value="until_25_per"/></div>
                    <div class="percent">100%</div>
                    <div class="output_calc"><Price font_size_unit="16px" :value="until_25_per"/></div>
                    <div class="total_calc"></div>             
                </div>
                <div class="row">
                    <div class="name_item left_gap">{{ `hiervon zu 50% anrechenbar (über 25% von ${summ_other}€)` }}</div>
                    <div class="imput_calc"><Price font_size_unit="16px" :value="after_25_per"/></div>
                    <div class="percent">50%</div>
                    <div class="output_calc"><Price font_size_unit="16px" :value="after_25_per*0.5"/></div>
                    <div class="total_calc"></div>             
                </div>
                <div class="row summ_row">
                    <div class="name_item">Summe nicht anrechenbare Kosten</div>
                    <div class="imput_calc"></div>
                    <div class="percent"></div>
                    <div class="output_calc"></div>
                    <div class="total_calc"><Price font_size_unit="16px" :value="(-1)*after_25_per*0.5"/></div>             
                </div>
            </div>
            <div class="total">
                <div class="total_points">
                    <div class="label">Summe eligible costs, "other": </div>
                    <div class="value"> <Price  font_size_unit="16px" :value="total"  :typeCurrancy="typeCurrancy"/> </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Price from '@/components/UI/Simples/Price.vue'
export  default{
  components: { Price },
    name: 'FinanceDetal',
    data(){
        return{
            collapse:true,
        }
    },
    emits:['useDetals', 'edit_UserTitle' ,'edit_price','count_total'],
    computed:{
        has_400_Bauwerk(){
            let result = !!this.list.find(item=>item.name.includes('400'))
            return result
        },
        kg400(){
            if(!this.has_400_Bauwerk) return 0
            let kg400 =  this.list.find(item=>item.name.includes('400')).value
            if(!kg400) kg400 = 0
            return Number( kg400 )
        },
        until_25_per(){
            if(!this.has_400_Bauwerk) return 0
            let result = this.summ_other*0.25
            if(this.kg400 < result) return this.kg400
            return this.summ_other*0.25
        },
        after_25_per(){
            if(!this.has_400_Bauwerk) return 0
            return this.kg400 - this.until_25_per
        },
        summ_other(){
            if(!this.has_400_Bauwerk) return 0
            return this.summ_100_800 - this.kg400
        },
        summ_100_800(){
            if(!this.has_400_Bauwerk) return 0
            return Number( this.list.reduce((sum, item) => sum + Number(!item.value?0:item.value),0) )
        },
        total(){
            let result = Number( this.list.reduce((sum, item) => sum + Number(!item.value?0:item.value),0) )
            result = Number(result - this.after_25_per*0.5)
            this.$emit('count_total', result)
            return result
        }
    },
    methods:{
        updatePrice(id, value){
            this.$emit('edit_price',{id, value })
        },
        updateUserTitle(id, value){
            this.$emit('edit_UserTitle',{id, value })
        }
    },
    props:{
        typeCurrancy:String,
        list: Array,
        useDetals:Boolean,
        
    }
}

</script>

<style scoped>

.wrap{
    display: flex;
    background-color: #fff;
    margin-left: 55px;
    margin-bottom: 15px;
    opacity: 0.5;
}
.wrap::before{
    position: relative;
    left: -26px;
    top: -15px;
    content: "";
    border-left: solid 1px #E4E4E4;
    box-shadow: 0px 30px 0px #000;
    margin-bottom: 35px;
}
.wrap.active{
    opacity: 1.0;
}
.list{
    width: 100%;
}
.detal-item{
    height: 30px;
    display: flex;
    justify-content: space-between;
    color: #8E8E8E;
    font-family:'Raleway-Light';
    font-size: 18px;
}

.title{
    color: #8E8E8E;
    width: 100%;
    font-family:'Raleway-Light';
    font-size: 18px;   
}

.value-wrap{
    display: flex;
    column-gap: 30px;
    font-size: 18px;
}

.total{
    display: flex;
    justify-content: flex-end;
    width: fit-content;
    column-gap: 30px;
    margin-left: auto;
    margin-top: 15px;
    padding-top: 5px;
    border-top: solid 1px #C7C7C7;
    color: #8E8E8E;
    font-family:'Raleway-Light';
    font-size: 18px;
}

.kg400_Bauwerk{
    margin-left:40px;
    color: #8E8E8E;
    font-family: 'Raleway-Light';
    font-size: 16px;
}

.kg400_Bauwerk .row{
    display: flex;
}

.header{
    border-bottom: 1px solid #c5c5c5;
    margin-bottom: 10px;  
    padding-bottom: 6px;
}

.name_item{
    width: 50%
}

.name_item.left_gap{
    padding-left: 40px;
}

.imput_calc{
    width: 12.5%;
    display: flex;
    justify-content: flex-end;
}
.percent{
    width: 12.5%;
    text-align: center;
}
.output_calc{
    width: 12.5%;
    display: flex;
    justify-content: flex-end;
}
.total_calc{
    width: 12.5%;
    display: flex;
    justify-content: flex-end;
}

.summ_row{
    border-top: 1px solid #bdbdbd;
    padding-top: 10px;
    margin-top: 6px;

}

.kg400_Bauwerk .header > div{
    justify-content: center;
}

.total_points{
    display: flex;
    column-gap: 15px;
}
</style>


