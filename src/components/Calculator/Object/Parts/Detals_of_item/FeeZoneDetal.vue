<template>
    <div class="wrap" >
        <div class="list">
            <div class="detal-item" v-for="item in data.list" :key="item.id">
                <input class="title" :placeholder="item.title" :value="item.user_title" @change="event => updateUserTitle(event.target.value, item.id)"/>
                <div class="value-wrap">
                    <div class="value">{{getValue( item.id )}}</div>
                    <div class="value-label">points</div>
                    <div class="bar_input">
                        <input class="slider" type="range" :min="item.min_value" :max="item.max_value" :value="getValue( item.id )" @change="event => updateValue(event.target.value, item.id)"> 
                    </div>
                </div>
            </div>
            <div class="total">
                <div class="total_points">
                    <div class="label">Total points: </div>
                    <div class="value">{{ data.total.value }}</div>
                </div>
                <div class="equivalent">
                    <div class="label">corresponds to fee zone: </div>
                    <div class="value">{{ data.total.equivalent }}</div>         
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export  default{
    name: 'FeeZoneDetal',
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
        updateValue(value, id_item){
            let parent_item = this.search_data.id_parent
            let name_value = this.data.name
            EventBus.emit('edit:input_detals',{parent_item, name_value, id_item, value })
        },
        updateUserTitle(value, id_item){
            let parent_item = this.search_data.id_parent
            let name_value = this.data.name
            EventBus.emit('edit:update_user_title',{ parent_item, name_value, id_item, value:value })
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

.value-wrap{
    display: flex;
    column-gap: 30px;
    font-size: 18px;
}

.title{
    color: #8E8E8E;
    width: 100%;
    font-family:'Raleway-Light';
    font-size: 18px;   
}

.slider {
    appearance: none; 
    width: 215px; 
    height: 10px; 
    background: #D9D9D9 ; 
    outline: none; 
    position: relative;
    overflow: hidden;

}

.slider::-webkit-slider-thumb {
    appearance: none; 
    width: 7px; 
    height: 10px; 
    border-radius: 2px; 
    border: solid 1px #7E7E7E;
    background: #FFFFFF;
    cursor: pointer; 
    box-shadow: -215px 0 0 215px #7E7E7E;
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



.total_points, .equivalent{
    display: flex;
    column-gap: 15px;
}

</style>
