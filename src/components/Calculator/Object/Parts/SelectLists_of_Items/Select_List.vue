<template>
    <ToggleListButton :close="!open" @switch_tg="(val)=>{open=val}"/>
    <div v-if="open" class="wrap">
    <div class="select-list" :class="{align_right:right}">
        <ul>
            <li v-for="item in list" :key="item.id" @click="select_data(item.val)" :class="{'active':item.val==sected_val}">{{ item.val }}</li>
        </ul> 
    </div>
    </div>
    <div v-if="open" @click="close()" class="bg_for_close_list"></div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name: 'Select_List',
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
    emits:['selected'],
    methods:{
        updateData(){
            this.list = this.data.list
            this.sected_val = this.data.value
        },
        select_data(val){
            this.$emit('selected',val)
            EventBus.emit('edit:input', {parent_item:this.data.id_parent, id_item:this.data.id, value:val})
            this.close()
        },
        close(){
            this.open = false;
        }
    }
}
</script>

<style scoped>
.wrap{
    position: absolute;
}
.select-list{
    position: relative;
    top: 9px;
    right:  calc(100% + 10px);
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
    cursor: pointer;
    width: 100%;
    text-align: left;
    font-family: 'Raleway-Light';
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

</style>