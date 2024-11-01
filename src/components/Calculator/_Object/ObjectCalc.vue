<template>
    <div class="object-calc">
        <ObjectTitile @switch_tg="(val)=>{collapse =  !val}"/>
        <Toggle :collapse="collapse">
        <Basis :object_id="object_id"/>
        <!-- <BaseServis :data="baseServis"/> -->
        </Toggle>
        <ObjectTotal :collapse="collapse"/>
    </div> 
    
</template>

<script>

import { getData } from '@/servis/getData.js'
import { calculate } from '@/servis/calculate.js'
export default{
    name: 'ObjectCalc',
    async mounted(){

    },
    data(){
        return{
            selected:{
                id_HOAI_v:'2',
                id_paragraph:'8',
            },
            collapse: false,
            data:{},
            basis:{},
            baseServis:{}
        }
    },
    props:{
        project_id:String,
        object_id:String,
    },
    methods:{
        initData(data){
            data.forEach(item=>item.list.forEach(list_item=>list_item.id_parent = item.id))
            this.basis = data.find(item=>item.name == 'Basis')
            this.baseServis = data.find(item=>item.name == 'BaseServis')
        },
        updateData(data){
            let value = data.value
            let id_item = data.id_item
            let parent_item = data.parent_item
            let parent = this.data.find(el=>el.id == parent_item)
            let el = parent.list.find(el=>el.id == id_item)
            el.value = value
            el.use_select = true
            calculate(this.data)
        },
        updateDataDetals( data, name_value = 'value' ){
            let parent = this.data.find(el=>el.id == data.parent_item)
            let element =  parent.list.find(el=>el.name == data.name_value)
            let detals = element.detail_input
            element.use_select = false
            let el = detals.list.find(item => item.id == data.id_item);
            el[name_value] = data.value
            calculate(this.data)
        },
    }
}
</script>

<style scoped>
    .object-calc{
        margin-top: 50px;
        margin-bottom: 90px;
        min-height: 500px;
    }

    .item{
        min-height: 100px;
    }

</style>