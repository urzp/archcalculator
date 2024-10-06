<template>
    <ToggleListButton v-if="list.length > 0" :close="!open" @switch_tg="(val)=>{open=val}"/>
    <div v-if="open" class="wrap">
    <div class="select-list" :class="{align_right:right}">
        <ul>
            <li v-for="item in list" :key="item.id" 
                @click="select_data(item)" 
                :class="{'active':item.id==data.id}">
                <template v-if="!!item.value">{{ item.value }}</template> 
                <template v-if="!!item.name">{{ item.name }}</template> 
                <template v-if="!!item.title">{{ item.title }}</template> 
                <DeleteButton class="deletButton"  @click.stop="delete_data(item)" width="35px" heigth="30px"/>
            </li>
            <li @click="newElement()">Add NEW</li>
        </ul> 
    </div>
    </div>
    <div v-if="open" @click="close()" class="bg_for_close_list"></div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'SelectEdit_List',
    mounted(){
        this.updateData()
    },
    data(){
        return{
            open: false,
            list: [],
            sected_val:'',
        }
    },
    props:{
        data: Object,
        right:{
            type:Boolean,
            default: false
        }
    },
    watch:{
        data: {
        handler() {
            this.updateData()
        },
        deep: true
        }
    },
    emits:['selected', 'newElementt','deleteElement'],
    methods:{
        updateData(){
            this.list = this.data.list
            this.sected_val = this.data.value
        },
        select_data(item){
            let val = item.value
            let id = item.id
            this.$emit('selected', {id_item:id, value:val})
            EventBus.emit('edit:input', {parent_item:this.data.id_parent, id_item:id, value:val})
            this.close()
        },
        newElement(){
            this.$emit('newElement')
            this.close()
        },
        close(){
            this.open = false;
        },
        delete_data(item){
            this.$emit('deleteElement', item)
            console.log(item)
        }
    }
}
</script>

<style scoped>
.wrap{
    height: 0px;
}
.select-list{
    position: relative;
    top: 9px;
    right:  calc(100% + 35px);
    padding: 10px 0px;
    background-color: #fff;
    background-color: #ffffff;
    border: solid 1px #D9D9D9;
    border-radius: 10px;
    z-index: 100;
}
.select-list.align_right{
    top: 29px;
    right: calc(100% + -216px);   
}
ul{
    display: flex;
    flex-direction: column;
    align-items: center; 
}
li{
    padding: 0 20px;
    margin-bottom: 5px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    column-gap: 15px;
    width: 100%;
    text-align: left;
    font-family: 'Raleway-Light';
    font-size: 18px;
    color: #464646;

}

li.active{
    color: var(--color-akcent);
    font-family: 'Raleway-Medium';   
}

li:hover{
    background-color: var(--color-akcent);
    color: #fff;
}

.bg_for_close_list{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: transparent;
    z-index: 10;
}

.deletButton{
    visibility: hidden;
}

li:hover .deletButton{
    visibility: visible;
}

</style>