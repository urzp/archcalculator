<template>
    <div class="item-Part-obj">
        <div class="title">{{ title }}</div>
        <div class="value">{{ getProperty('value') }}</div>
        <div class="select-list"> 
            <Select_List :list="getProperty('list')"/>
            <!-- v-if="this.$slots._" -->
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
        getProperty(type){
            let val = ''
            let t = this.title
            let d = this.data
            if(!(!!t&&!!d&&!!d[t])) return ''
            val = d[t]
            val = val[type]
            return val
        },
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