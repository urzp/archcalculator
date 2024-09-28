<template>
    <div class="object-calc">
        <ObjectTitile @switch_tg="(val)=>{collapse =  !val}"/>
        <Toggle :collapse="collapse">
        <Basis :data="basis"/>
        <BaseServis :data="baseServis"/>
        </Toggle>
        <ObjectTotal :collapse="collapse"/>
    </div> 
    
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { getData } from '@/servis/getData.js'
export default{
    name: 'ObjectCalc',
    async mounted(){
        this.data = getData()
        this.initData(this.data)
        EventBus.on('SelectList', (data)=>{this.selectItem(data)})
        EventBus.on('edit:input', (data)=>{this.updateData( data.value, data.name_value)})
        EventBus.on('edit:input_detals', (data)=>{this.updateDataDetals( data.name_value, data.id_item, data.value )})
        EventBus.on('edit:update_user_title', (data)=>{this.updateDataDetals( data.name_value, data.id_item, data.value, 'user_title' )})
        this.calculate()
    },
    data(){
        return{
            collapse: false,
            data:{},
            basis:{},
            baseServis:{}
        }
    },
    methods:{
        initData(data){
            data.forEach(item=>item.list.forEach(list_item=>list_item.id_parent = item.id))
            this.basis = data.find(item=>item.name == 'Basis')
            this.baseServis = data.find(item=>item.name == 'BaseServis')
        },
        selectItem(data){
            let value = data.value
            let id_item = data.id_item
            let parent_item = data.parent_item
            let parent = this.data.find(el=>el.id == parent_item)
            let el = parent.list.find(el=>el.id == id_item)
            el.value = value
            el.use_select = true
            this.calculate()
        },
        updateData(val, item_name){
            if(!val||!item_name) return false
            let el = this.basis.list.find(el=>el.name == item_name)
            el.value = val
            el.use_select = true
            this.calculate()
        },
        updateDataDetals( item_name, id_item, val, name_value = 'value' ){
            let element = this.basis.list.find(el=>el.name == item_name)
            let detals = element.detail_input
            element.use_select = false
            let el = detals.list.find(item => item.id == id_item);
            el[name_value] = val
            this.calculate()
        },
        calculate(){
            let Surcharge = this.basis.list.find(el=>el.name == 'Surcharge')
            let Fee_table = this.basis.list.find(el=>el.name == 'Fee according to fee table')
            Surcharge.price = Surcharge.value * 0.01 * Fee_table.value
            this.calculate_detals("Fee zone")
            this.calculate_detals("Eligible costs")
            this.calculate_fee_table_value()
            this.basis.Total.value = Fee_table.value + Surcharge.price
        },
        calculate_detals(item_name){
            if (!item_name) return false
            let element = this.basis.list.find(el=>el.name == item_name)
            let detals = element.detail_input 
            let total = 0
            detals.list.forEach(element => {
                let val = element.value==''?element.def_value:element.value
                total = total + Number(val)
            });
            detals.total.value = total
            if(item_name=="Fee zone"){
                let equivalent = detals.equivalents.find(item => total < item.value);
                detals.total.equivalent = equivalent.name
                if(!element.use_select) element.value = equivalent.name
            }
            if(item_name=="Eligible costs"){
                if(!element.use_select) element.value = detals.total.value
            }
        },
        calculate_fee_table_value(){
            let element = this.basis.list.find(el=>el.name == "Fee according to fee table")
            let Fee_Table = element.detail_input
            let min = Fee_Table.current.min_fee
            let max = Fee_Table.current.max_fee
            let el_free_rate = this.basis.list.find(el=>el.name == "Fee rate")
            let name_val = el_free_rate.value
            let list = el_free_rate.list
            let fee_rate_procent = list.find(item => item.val == name_val).percent
            let fee_value = min + (max-min) * (fee_rate_procent/100)
            element.value = fee_value
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