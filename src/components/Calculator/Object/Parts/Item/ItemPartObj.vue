<template>
    <div class="item-Part-obj">
        <div v-if="haveDetals()" class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div class="main_row">
            <div class="title">{{ title }}</div>
            <div class="value" v-if="typeOf('text')" >{{ getProperty('value') }}</div>
            <div class="price" v-if="typeOf('price')" ><Price :input_type="input_type" :value ="getProperty('value')" :name_value="title"/></div>
            <div v-if="haveSelList()" class="select-list" > 
                <Select_List :list="getProperty('list')" :name_list="title" :sected_val="getProperty('value')"/>
            </div>
            <div class="count_percent" v-if="typeOf('count_percent')">
                <Percent :input_type="input_type" :value = "getProperty('value')" :name_value="title"/>
                <Price :value ="getProperty('price')"/> 
            </div>
        </div>
        <div v-if="haveDetals()&&!collapse_detals" class="detal-list">
            <DetalsList :data="getDetals()"/>
        </div>
        <slot/><!-- v-if="this.$slots._" -->
    </div>
</template>

<script>
export  default{
    name: 'ItemPartObj',
    data(){
        return{
            collapse_detals:true,
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
        haveDetals(){
            let result = false
            let t = this.title
            let d = this.data
            if(!(!!t&&!!d&&!!d[t])) return result
            if(!!d[t].detail_input) result = true
            return result
        },
        getDetals(){
            let result = {}
            let t = this.title
            let d = this.data
            if(!(!!t&&!!d&&!!d[t])) return result
            if(!!d[t].detail_input) result = d[t].detail_input
            return result
        },
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
    computed:{
        
    }
}
</script>

<style scoped>
    .item-Part-obj{
        display: flex;
        flex-direction: column;
    }
    .item-Part-obj .main_row{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
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

    .price{
        color:#838383;
    }
    .unit-price{
        color:#838383;
        
    }

    .count_percent{
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color:#838383;
    }

</style>