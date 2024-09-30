<template>
    <div class="wrap" >
        <div class="list">
            <div class="detal-item" v-for="item in data.list" :key="item.id">
                <input class="title" :placeholder="item.title" :value="item.user_title" @change="event => updateUserTitle(event.target.value, item.id)"/>
                <div class="value-wrap">
                    <Price input_type font_size_unit="18px" :value="getValue( item.id )" @edit_price="val=>updatePrice(item.id, val)" :search_data="search_data"/>
                </div>
            </div>
            <div class="total">
                <div class="total_points">
                    <div class="label">Total eligible costs, "other": </div>
                    <div class="value"> <Price  font_size_unit="18px" :value="data.total.value"/> </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export  default{
    name: 'EligibleCostsDetal',
    data(){
        return{
            collapse:true,
        }
    },
    methods:{
        getValue(id){
           let el = this.data.list.find(item => item.id == id);
           let result = el.value==''?el.def_value:el.value
           return result
        },
        updatePrice(id_item, value){
            let parent_item = this.search_data.id_parent
            let name_value = this.data.name
            EventBus.emit('edit:input_detals',{parent_item, name_value, id_item, value })
        }
    },
    props:{
        data: Object,
        search_data:{
            typeof:Object,
            default:{id_parent:'0', id:'0'}
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
    box-shadow: 0px 30px 0px #000;
    margin-bottom: 35px;
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



.total_points{
    display: flex;
    column-gap: 15px;
}
</style>


