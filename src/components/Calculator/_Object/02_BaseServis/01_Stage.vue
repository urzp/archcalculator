<template>
    <div class="item-Part-obj">
        <div  class="main_row" >
            <div class="title">{{ title }}</div>
            <div class="wrap-numbers">
                <div class="wrap-percents">
                    <Percent :class="'default_percent'" :value = "percent_def" />
                    <Percent :class="'input_percent'" input_type :value = "percent" @edit_value="value=>updatePercent(value)"/>
                </div>    
                <div class="price" ><Price :value ="value" /></div>
            </div>
        </div>
    </div>
</template>

<script>
export  default{
    name: 'Stage',
    async mounted(){
    },
    data(){
        return{
            value:'',
        }
    },
    props:{
        id:String,
        title:String,
        honorar:Number,
        percent:Number,
        percent_def:Number
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
    .main_row{
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
        color: #999;
    }
    .input_percent{
        width: 50px;
        justify-content: flex-end;       
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