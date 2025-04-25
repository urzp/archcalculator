<template>
    <div class="wrap_elements">
        <!-- <div class="date" >
            {{ formatDate(value) }}
        </div> -->
        <input v-if="!!value&&!isShowProject" type="date" :value="formatDate(value)" @blur="event=>setNewDate(new Date( event.target.value ) )">
        <div v-if="!!value&&isShowProject">{{ formatDate(value) }}</div>
        <div v-if="!value" class="date">-</div>
        <div v-if="!isShowProject" class="wrap_button">
            <CalendatBtn :height="'25px'" :width="'15px'" :width_img="'19px'" @click.stop="begin_edit()"/>
        </div>
    </div>
    <div v-if="showCalendar&&!isShowProject" class="selectData" @click.stop="">
        <div class="wrap_calendar">
            <Calendar 
                popap :openMonth="openDate" :selectDay="openDate" 
                :projects="[]" @selectDay="date=>setNewDate(date)" 
                @closeCalendar="showCalendar=false"/>
        </div>
    </div>
</template>

<script>
import { checkLock } from '@/servis/projectData';
export default{
    name:'InputDate',
    data(){
        return{
            showCalendar:false,
        }
    },
    props:{
        value:[String, Date],
        lock:{
            type:[Boolean, String],
            default: false,
        }
    },
    emits:['editValue'],
    computed:{
        openDate(){
            if(!this.value) return new Date()
            return new Date(this.value)
        },     
        isShowProject(){
            let result = false
            if(!!this.$route.query&&!!this.$route.query.bill) result = true
            if(this.lock==true) result = true
            if(this.lock=='1') result = true
            return result
        },
    },
    methods:{
        formatDate(date){
            if(!date) return '-'
            date = new Date(date)
            //date = date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
            date = date.getFullYear() + '-' +  ('0'+(date.getMonth()+1)).slice(-2) + '-' + ('0'+date.getDate()).slice(-2)
            return date
        },
        setNewDate(date){
            console.log(date)
            this.$emit('editValue', date)
            this.showCalendar=false
        },
        begin_edit(){
            if(checkLock()) return false
            this.showCalendar=true
        },
    }
}

</script>

<style scoped>
    .wrap_elements{
        display: flex;
        align-items: center;
        margin-right: -30px;
        padding-right: 30px;
    }
    .date{
        min-width: 20px;
        text-align: center;
    }
    .wrap_button{
        display: none;
        position: relative;
        left: 5px;
        width: 0;
    }
    .wrap_elements:hover .wrap_button{
        display: flex;
    }
    .selectData{
        position: relative;
        width: 0;
        height: 0;
    }
    .wrap_calendar{
        position: absolute;
        display: flex;
        justify-content: center;
        right: 5px;
        top: 30px;
        width: 350px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 15px #898989d6;
        background-color: #fff;
        z-index: 100;
    }

    [type="date"]::-webkit-inner-spin-button {
        display: none;
    }
    [type="date"]::-webkit-calendar-picker-indicator {
        display: none;
    }
    input{
        font-family: inherit;
        font-size: inherit;
        text-align: right;
        color: inherit;
    }
</style>