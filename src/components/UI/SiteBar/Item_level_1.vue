<template>
        <div class="item_level_1" @click="click_handling()" >
            <Marker v-if="!!marker_type" :active="active" :level="marker_type"/>
            <div v-if="!!title" class="title" :class="{active}">{{ title }}</div>
            <div v-if="!!project_data" class="name_poject" :class="{active}" @click.stop="openProject()">{{ project_data.name }} </div>
            <div v-if="!!project_data&&!bills" class="from_date" :class="{active}">{{ from_date }}</div>
        </div>
        <div v-if="bills&&showBills" class="item_level_1 bills">
                <div class="contract" @click.stop="openProject()">{{ text.contract }}</div>
                <div class="newBill"  @click.stop="newBill()">{{ text.newBill }}</div>
                <div class="bills_list" @click="openBills()">{{ text.bills }} </div>
        </div>
</template>

<script>
import {text} from '@/servis/text'
import {dateToStringNoTime} from '@/servis/functions'
import { EventBus } from '@/servis/EventBus'
import {projectToBill} from '@/servis/projectData'
export default{
    name: 'Item_level_1',
    data(){
        return {
            text:{
                from_today: text.sideBar.from_today,
                from_yestoday: text.sideBar.from_yestoday,
                from: text.sideBar.from,
                contract: text.sideBar.contract,
                newBill: text.sideBar.newBill,
                bills: text.sideBar.bills,
            },
            showBills: false,
        }
    },
    emits:['click'],
    props:{
        marker_type:{
            type: [String, Number, Boolean],
            default: false,
        },
        title:{
            type:String,
            default:'',
        },
        project_data: {
            type: [Array, Object],
            default: null,
        },
        bills:{
            type: Boolean,
            default: false,
        },
        active:{
            type: Boolean,
            default: false,
        }
    },
    computed:{
        from_date(){
            let result = ''
            if(!this.project_data&&!this.project_data.created) return result
            let today = new Date()
            let project_created = new Date(this.project_data.created )
            if(today.toDateString() == project_created.toDateString()) result = this.text.from_today
            else if(new Date(today.setDate(today.getDate() - 1)).toDateString() == project_created.toDateString()) result = this.text.from_yestoday
            else result = this.text.from + " " + dateToStringNoTime(project_created)
            return result
        },
        is_level_2(){
            let result = false
            if(!!this.project_data&&!!this.project_data.include_data) result = true
            return result
        },
        level_marker(){
            let result = 1
            if(this.is_level_2) result = 0
            return result
        }
    },
    methods:{
        click_handling(){
            this.$emit('click')
            if(!!this.project_data&&!this.bills) this.openProject()
            if(this.bills) this.showBills=!this.showBills
        },
        openProject(){
            EventBus.emit('MenuProjects:closeBills')
            EventBus.emit('Project:openProject', this.project_data.id)
        },
        async openBills(){
            EventBus.emit('Project:openProject', this.project_data.id)
            EventBus.emit('MenuProjects:showBills')
        },
        async newBill(){
           await projectToBill(this.project_data.id)
           EventBus.emit('MenuProjects:showBills')
        }
    }
}
</script>

<style scoped>
.name_poject{
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.item_level_1{
    display: flex;
    column-gap: 8px;    
    font-family: 'Raleway-Medium';
    font-size: 16px;
    margin-left: 17px;
    margin-bottom: 5px;
    cursor: pointer;
}
.bills{
    margin-left: 37px;
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
}
.title.active, .name_poject.active, .from_date.active{
    color: #ed994a;
}
</style>