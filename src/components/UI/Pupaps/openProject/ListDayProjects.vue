<template>
    <div class="list_recent_projects">
        <div class="title">{{ select_day.toLocaleString("de-DE", {day:'numeric',month:'short', year:'numeric'}) }}</div>
        <div class="list">
            <div class="item" v-for="item in sortRicent" :key="item.id" @click="openProject(item.id)" @mouseover="showProject(item.id)">
                <div class="name">{{ item.name }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import { isSameDate } from '@/servis/functions'
export default{
    name:'ListDayProjects',
    data(){
        return{

        }
    },
    props:{
        list: {
            type: Array,
            default: [],
        },
        select_day: Date,
    },
    emits:['openProject','showProject'],
    computed:{
        sortRicent(){
            let result = this.list.map(a => ({...a}));
            result = result.filter(item=>isSameDate(new Date(item.created), this.select_day) )
            return result
        }
    },
    methods:{
        openProject(id){
            this.$emit('openProject', id)
        },
        showProject(id){
            this.$emit('showProject', id)
        }
    }

}

</script>

<style scoped>
.list_recent_projects{
    width: calc(40% - 20px);
    margin-right: 20px;
}

.title{
    width: 100%;
    font-family: 'Raleway-Medium';
    font-size: 18px;
    color: #ebaa6c;
    padding-right: 20px;
    border-bottom: 1px solid #e2e2e2;
    margin-bottom: 10px;
}

.item{
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    align-items: center;
    cursor: pointer;
}

.name_price{
    margin-right: 5px;
}

.name{
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    color:#464646;
    font-family: 'Raleway-Light';
    font-size: 16px;
}

.list{
    overflow-y: auto;
    max-height: 250px;
    scrollbar-color: #7E7E7E #EDEDED;
    scrollbar-width: thin;
}

.item:hover{
    background-color: #EBAA6C;
    padding-left: 5px;
}

.item:hover .name{
    color:#fff;
}

</style>