<template>
    <div class="item-Part-obj">
        <div class="title">{{ title }}</div>
        <div class="value" v-if="typeOf('text')" >{{ getProperty('value') }}</div>
        <div class="pice" v-if="typeOf('price')" ><Price :input_type="input_type" :value ="getProperty('value')"  @edit_price="val=>updateValue(val,'edit_price')"/></div>
        <div v-if="haveSelList()" class="select-list" > 
            <Select_List :list="getProperty('list')" :name_list="title" :sected_val="getProperty('value')"/>
            <slot/><!-- v-if="this.$slots._" -->
        </div>
        <div class="count_percent" v-if="typeOf('count_percent')">
            <Percent :input_type="input_type" :value = "getProperty('value')" @edit_value="val=>updateValue(val,'edit_percent')"/>
            <Price :value ='0'/> 
        </div>
    </div>
</template>

<script>
export  default{
    name: 'ItemPartObj',
    data(){
        return{
            collapse:true
        }
    },
    props:{
        title:String,
        data:String,
        input_type:{
            type:Boolean,
            default: false,
        }
    },
    methods:{
        typeOf(type){
            let result = false
            let t = this.title
            let d = this.data
            if(!(!!t&&!!d&&!!d[t])) return result
            if( d[t].type == type ) result = true
            return result
        },
        haveSelList(){
            let result = false
            let t = this.title
            let d = this.data
            if(!(!!t&&!!d&&!!d[t])) return result   
            result =  !!d[t].list        
            return result
        },
        getProperty(type){
            let val = ''
            let t = this.title
            let d = this.data
            if(!(!!t&&!!d&&!!d[t])) return ''
            val = d[t]
            val = val[type]
            if (!val||val.length == 0) return ''
            return val
        },
        updateValue(val, name_emint){
            this.$emit(name_emint, val)
        }
    },
    emits:['edit_price', 'edit_percent'],
}
</script>

<style scoped>
    .item-Part-obj{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
    }
    .title{
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .select-list{
        margin-left: 20px;
        margin-right: 10px;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .price, .price .unit-price{
        color:#838383;
        padding-right: 9px;
    }

    .count_percent{
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color:#838383;
    }

</style>