<template>
    <div class="item_level_1" :class="{item_button:button_type}">
        <Marker v-if="!button_type" :level="1"/>
        <div v-if="!!title" class="title">{{ title }}</div>
        <div v-if="!!project_data" class="name_poject">{{ project_data.title }}</div>
        <div v-if="!!project_data" class="from_date">{{ from_date }}</div>
    </div>
</template>

<script>
import {text} from '@/servis/text'
import {dateToStringNoTime} from '@/servis/functions'
export default{
    name: 'Item_level_1',
    data(){
        return {
            text:{
                from_today: text.sideBar.from_today,
                from_yestoday: text.sideBar.from_yestoday,
                from: text.sideBar.from,
            },
        }
    },
    props:{
        button_type: {
            type:Boolean,
            default:false,
        },
        title:{
            type:String,
            default:'',
        },
        project_data: {
            type: [Array, Object],
            default: null,
        }
    },
    computed:{
        from_date(){
            let result = ''
            if(!this.project_data&&!this.project_data.date) return result
            let today = new Date()
            let project_created = new Date(this.project_data.date)
            if(today.toDateString() == project_created.toDateString()) result = this.text.from_today
            else if(new Date(today.setDate(today.getDate() - 1)).toDateString() == project_created.toDateString()) result = this.text.from_yestoday
            else result = this.text.from + " " + dateToStringNoTime(project_created)
            return result
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
</style>