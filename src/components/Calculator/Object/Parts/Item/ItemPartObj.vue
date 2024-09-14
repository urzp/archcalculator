<template>
    <div class="item-Part-obj">
        <div class="title" @click="console.log(this.$slots._)">{{ title }}</div>
        <div class="value">{{ select_value() }}</div>
        <div class="select-list" v-if="this.$slots._">
            <slot/>
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
        data:String
    },
    methods:{
        select_value(){
            let val = ''
            let t = this.title
            let d = this.data
            if(!!t&&!!d) val = d[t]
            return val
        }
    }
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
</style>