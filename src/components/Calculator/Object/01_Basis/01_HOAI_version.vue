<template>
    <div class="main_row">
        <div class="title">{{ text.HOAI_Version }}</div>
        <div class="value">{{ data.value }}</div>
        <div  class="select-list" >
            <Select_List v-if="!isShowProject" :data="data" stopEventBus @selected="(data)=>select(data)"/>
        </div>
    </div>
</template>

<script>
import { CalcData } from '@/servis/calcData.js'
import { text } from '@/servis/text.js'
export  default{
    name: 'HOAI_version_calc',
    async mounted(){
        await this.getData()
        this.dataUpdate()
    },
    data(){
        return{
            data:{
                id:'',
                value: '',
                list:[],
            },
            text:{
                HOAI_Version: text.Calc.HOAI_Version 
            }
        }
    },
    props:{
        prop_id:[String, Number],
    },
    watch:{
        async prop_id(){
           this.dataUpdate()
        },
    },
    computed:{
        isShowProject(){
            let result = false
            if(!!this.$route.query&&!!this.$route.query.project) result = true
            if(!!this.$route.query&&!!this.$route.query.bill) result = true
            return result
        }
    },
    emits:['selected'],
    methods:{
        async getData(){
            this.data.list = CalcData.HOAI_versions.filter(item=>item.puplish=='1')
        },
        select(data){
            data.id = data.id_item
            this.dataUpdate(data.id)
            this.$emit('selected', data)
        },
        dataUpdate(id = this.prop_id ){
            if(!this.data.list)return false
            this.data.id = id
            let element = this.data.list.find(item=>item.id==id)
            if(!!element){ this.data.value = element.value }
        },
        
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
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .select-list{
        margin-left: 20px;
        margin-right: 10px;
    }
</style>