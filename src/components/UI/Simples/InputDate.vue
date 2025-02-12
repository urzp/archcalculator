<template>
    <div class="date" @click.stop="showCalendar=true">
        {{ formatDate(value) }}
    </div>
    <div v-if="showCalendar" class="selectData" @click.stop="">
        <div class="wrap_calendar">
            <Calendar 
                popap :openMonth="openDate" :selectDay="openDate" 
                :projects="[]" @selectDay="date=>setNewDate(date)" 
                @closeCalendar="showCalendar=false"/>
        </div>
    </div>
</template>

<script>
export default{
    name:'InputDate',
    data(){
        return{
            showCalendar:false,
        }
    },
    props:{
        value:[String, Date]
    },
    emits:['editValue'],
    computed:{
        openDate(){
            if(!this.value) return new Date()
            return new Date(this.value)
        }   
    },
    methods:{
        formatDate(date){
            if(!date) return '-'
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        setNewDate(date){
            this.$emit('editValue', date)
            this.showCalendar=false
            
        }
    }
}

</script>

<style scoped>
    .date{
        min-width: 20px;
        text-align: center;
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
</style>