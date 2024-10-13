<template>
    <ToggleListButton v-if="list.length > 0" :close="!open" @switch_tg="(val)=>{open=val}"/>
    <div v-if="open" class="wrap">
    
    <div class="select-list" :class="{align_right:right}">
        <ul>
            <li v-for="item, index in list" :key="item.id" 
                @click="select_data(item)" 
                :class="{'active':item.id==data.id}">
                <div class="left-part">
                    <div v-if="!!item.value">{{ item.value }}</div> 
                    <div v-if="!!item.name">{{ item.name }}</div> 
                    <div v-if="!!item.title">{{ item.title }}</div> 
                </div>
                <div class="button_panel">
                    <UpButton @click.stop="moveItem(index, 'up')"  width="35px" heigth="30px"/>
                    <DownButton @click.stop="moveItem(index, 'down')"  width="35px" heigth="30px"/>
                    <DeleteButton   @click.stop="delete_data(item)" width="35px" heigth="30px"/>
                </div>

            </li>
            <li @click="newElement()">Add NEW</li>
        </ul> 
    </div>
    </div>
    <div v-if="open" @click="close()" class="bg_for_close_list"></div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
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
    emits:['selected', 'newElementt','deleteElement','moveElement'],
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
        },
        async moveItem(index, derect){
            if( index==0 && derect=='up' ) return false
            if( index==this.list.length - 1 && derect=='down' ) return false

            let element = this.list[index]
            let sequence = index + 1
            let nextSequence


            if (derect=='up') nextSequence = sequence - 1
            if (derect=='down') nextSequence = sequence + 1
            let nextElement = this.list[nextSequence - 1]

            element.sequence = nextSequence
            nextElement.sequence = sequence
            
            await apiData({typeData:'updateParagraph', data:element})
            await apiData({typeData:'updateParagraph', data:nextElement})
            this.$emit('moveElement')
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
    padding: 20px 0px;
    background-color: #fff;
    background-color: #ffffff;
    border: solid 1px #D9D9D9;
    border-radius: 10px;
    z-index: 100;
}

.select-list ul{
    overflow-y: auto;
    max-height: 450px;
}
.select-list.align_right{
    top: -10px;
    right: 0px; 
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

.left-part{
    display: flex;
    column-gap: 5px;
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

.button_panel{
    display: flex;
    column-gap: 5px;
    visibility: hidden;
}

li:hover .button_panel{
    visibility: visible;
}

.button_panel:hover{
    visibility: visible;
}

</style>