<template>
        <div class="calendar">
            <div class="calendar_header">
                <div class="month_panel">
                    <div class="down" @click="setMonth(-1)"><img src="@/assets/icons/btn_down/tick.svg" alt=""></div>
                    <div class="month">{{ settedData.toLocaleString("de-DE", {month:'long'}) }}</div>
                    <div class="up" @click="setMonth(1)"><img src="@/assets/icons/btn_up/tick.svg" alt=""></div>
                </div>
                <div>|</div>
                <div class="year_panel">
                    <div class="down" @click="setYear(-1)"><div class="down"><img src="@/assets/icons/btn_down/tick.svg" alt=""></div></div>
                    <div class="month">{{ year }}</div>
                    <div class="up" @click="setYear(1)"><div class="up"><img src="@/assets/icons/btn_up/tick.svg" alt=""></div></div>   
                </div>
            </div>
            <div class="wheek_days">
                <div class="week_day" v-for="item in weekNames" :key="item">{{ item }}</div>
            </div>
            <div class="days">
                <div class="wheek_row" v-for="week_item in [0,1,2,3,4]" :key="week_item"> 
                        <div class="item" 
                            :class="{project:item.project, select:item.select, current_month:item.current_month}" 
                            v-for="item in days_month.slice(week_item * 7, (week_item + 1) * 7 )" :key="item.id"
                            @click="select_Day(item.day)"    
                        >
                            {{ item.day.getDate() }}
                        </div> 
                </div>
            </div>
        </div>
        <div v-if="popap" @click.stop="$emit('closeCalendar')" class="bg_for_close"></div>   
</template>

<script>
import { isSameDate } from '@/servis/functions'
export default{
    name:'Calendar',
    mounted(){
        this.month = this.openMonth.getMonth() + 1,
        this.year = this.openMonth.getFullYear()
    },
    data(){
        return{
            weekNames:['Su','Mo','Tu','We','Th','Fr', 'Sa'],
            month: new Date().getMonth() + 1,
            year: new Date().getFullYear(),
        }
    },
    emits:['selectDay', 'closeCalendar'],
    props:{
        projects:Array,
        selectDay: Date,
        popap:{
            type:Boolean,
            default:false
        },
        openMonth:{
            type: Date,
            default: new Date()
        }
    },
    computed:{
        settedData(){
            return new Date(`${this.year}.${this.month}.1`);
        },
        days_month(){
            let result = []
            let firstSu = this.settedData;
            firstSu.setDate(firstSu.getDate() - (firstSu.getDay() + 7) % 7);
            for(let i=0; i<=34; i++){
                let i_day = firstSu.addDays(i)
                let day = {
                    id:i, 
                    day:i_day, 
                    project:this.projects.find( item=>isSameDate(new Date(item.created), i_day) ),
                    select: isSameDate(this.selectDay, i_day),
                    current_month: i_day.getMonth() == this.month - 1
                }
                result.push(day)
            }
            return result
        }
    },
    methods:{
        setMonth(value){
            if(this.month + value > 12){
                this.month = 1;
                this.setYear(1)
                return true
            }
            if(this.month + value < 1){
                this.month = 12;
                this.setYear(-1)
                return true
            }
            this.month = this.month + value
        },
        setYear(value){
            this.year = this.year + value
        },
        select_Day(day){
            this.$emit('selectDay',day)
        }
    }
}
</script>

<style>

    .calendar{
        width: 270px;
        z-index: 100;
    }

    .calendar_header{
        display: flex;
        column-gap: 4px;
        justify-content: space-between;
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#575757;
    }

    .month_panel, .year_panel{
        display: flex;
        justify-content: space-between;
    } 

    .month_panel{
        width: 60%;
    }

    .year_panel{
        width: 40%;
    }

    .down, .up{
        width: 25px;
        text-align: center;
        cursor: pointer;
    }

    .wheek_days, .wheek_row{
        margin: 10px 0;
        display: flex;
        justify-content: space-between;
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .wheek_row{
        color:#c7c7c7;
    }

    .wheek_row .current_month {
        color: #464646;
    }

    .wheek_row .item{
        width: 24px;
        text-align: center;
        cursor: pointer;
    }

    .wheek_row .item.project{
        background-color: #B9B9B9;
        color: #fff;       
    }

    .wheek_row .item.select{
        background-color: #FF9800;
        color: #fff;
    }

    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }
</style>