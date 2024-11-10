<template>
        <div class="item-Part-obj">
            <div v-if="false" class="detals" @click="collapse_detals=!collapse_detals">
                <div class="icon"></div>
            </div>
            <div  class="main_row" >
                <div class="title">{{ title }}</div>
                <div class="wrap-numbers">
                    <div class="wrap-percents">
                        <Percent :class="'default_percent'" :value = "percent_def" font_size_value="16px" font_size_sumbol="14px" />
                        <Percent :class="'input_percent'" input_type :value = "percent" @edit_value="value=>updatePercent(value)" font_size_value="16px" font_size_sumbol="14px"/>
                    </div>    
                    <div class="price" ><Price :value ="value" font_size_unit="16px" font_size_cent="14px" /></div>
                </div>
            </div>
            <div v-show="!collapse_detals" class="detal-list">
                
            </div>
        </div>
</template>

<script>
export  default{
    name: 'Stage_calc_L0',
    async mounted(){
    },
    data(){
        return{
            collapse_detals:true,
        }
    },
    props:{
        id:String,
        title:String,
        honorar:[Number, String],
        percent: [Number, String],
        percent_def:[Number, String]
    },
    emits:['updatePercent'],
    watch:{

    },
    computed:{
        value(){
            return this.honorar * this.percent/100
        }
    },
    methods:{  
        updatePercent(value){
            this.$emit('updatePercent', {value, id:this.id})
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
    box-shadow: 0px 18px 0px #000;
    margin-bottom: 0px;
}
    .main_row{
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }   
    .title{
        max-width: 760px;
        margin-left: 55px;
        margin-top: 5px;
        margin-bottom: 5px;
        font-family: 'Raleway-Light';
        font-size: 16px;
        color: #888;
    }

    .wrap-numbers{
        width: 300px;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
    }
    .wrap-percents{
        display: flex;
        column-gap: 45px;
        align-items: baseline;
    }
    .default_percent{
        width: 50px;
        justify-content: flex-end;
        color: #cccccc;
        font-size: 16px;
    }
    .input_percent{
        width: 50px;
        justify-content: flex-end;       
        font-size: 16px;
        color: #999;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 16px;
        color:#464646;
        margin-left: auto;
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
</style>