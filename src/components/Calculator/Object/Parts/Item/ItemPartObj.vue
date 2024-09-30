<template>
    <div class="item-Part-obj">
        <div v-if="haveDetals()" class="detals" @click="collapse_detals=!collapse_detals">
            <div class="icon"></div>
        </div>
        <div class="main_row">
            <div class="title">{{ title }}</div>
            <div class="value" v-if="typeOf('text')" >{{ value }}</div>
            <div v-if="haveSelList()" class="select-list" > 
                <Select_List :data="data"/>
            </div>
            <div class="price" v-if="typeOf('price')" ><Price :input_type="input_type" :value ="value" :search_data="data"/></div>
            <div class="count_percent" v-if="typeOf('count_percent')">
                <Percent :input_type="input_type" :value = "value" :search_data="data"/>
                <Price :value ="price"/> 
            </div>
            <div class="count_percent" v-if="typeOf('count_percent_default')">
                <Percent :value = "value" />
                <Percent :input_type="input_type" :value = "value" :search_data="data"/>
                <Price :value ="price"/> 
            </div>
        </div>
        <div v-if="haveDetals()&&!collapse_detals" class="detal-list">
            <FeeZoneDetal v-if="title=='Fee zone'" :data="detals" :search_data="data"/>
            <EligibleCostsDetal v-if="title=='Eligible costs'" :data="detals"  :search_data="data"/>
            <FeeTableDetal v-if="title=='Fee according to fee table'" :data="detals"/>
        </div>
        <slot/><!-- v-if="this.$slots._" -->
    </div>
</template>

<script>
export  default{
    name: 'ItemPartObj',
    mounted(){
        this.updateData()
    },
    data(){
        return{
            title:'',
            value:'',
            price: 0,
            list:[],
            detals:{},
            input_type: false,
            collapse_detals:true,
        }
    },
    props:{
        data:Object,
    },
    watch:{
        data: {
        handler() {
            this.updateData()
        },
        deep: true
        }
    }
    ,
    methods:{
        haveDetals(){
            let result = false
            let d = this.data
            if(!d) return result
            if(!!d.detail_input) result = true
            return result
        },
        typeOf(type){
            let result = false
            let d = this.data
            if(!d) return result
            if( d.type == type ) result = true
            return result
        },
        haveSelList(){
            let result = false
            let d = this.data
            if(!d) return result   
            result =  !!d.list        
            return result
        },
        updateData(){
            this.title = this.data.name
            this.value = this.data.value
            this.list = !!this.data.list?this.data.list:[]
            this.input_type = !!this.data.input_type?this.data.input_type:false
            this.price = !!this.data.price?this.data.price:0
            this.detals = !!this.data.detail_input?this.data.detail_input:{}   
        }
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