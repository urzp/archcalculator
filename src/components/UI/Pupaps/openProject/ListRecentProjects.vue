<template>
    <div class="list_recent_projects">
        <div class="title">{{ text.Recent }}</div>
        <div class="item" v-for="item in sortRicent.slice(0, 8)" :key="item.id" @click="openProject(item.id)" @mouseover="showProject(item.id)">
            <div class="name">{{ item.name }}</div>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export default{
    name:'ListRecentProjects',
    data(){
        return{
            text:{
                Recent: text.openProject.Recent,
            }
        }
    },
    props:{
        list: {
            type: Array,
            default: [],
        }
    },
    emits:['openProject','showProject'],
    computed:{
        sortRicent(){
            let result = this.list.map(a => ({...a}));
            result = result.sort((a,b)=>{
                a = new Date(a.updated); b = new Date(b.updated)
                if (a > b) return -1; if (a == b) return 0; if (a < b) return 1;
            })
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
    font-family: 'Raleway-Light';
    font-size: 18px;
    color: #464646;
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

.item:hover{
    background-color: #EBAA6C;
    padding-left: 5px;
}

.item:hover .name{
    color:#fff;
}

</style>