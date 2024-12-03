<template>
    <div class="list_all_projects">
        <div class="title">All Projects</div>
        <div class="list">
            <div class="item" v-for="item in listSort" :key="item.id" @click="openProject(item.id)" @mouseover="showProject(item.id)">
                <div class="name_price">
                    <div class="name">{{ item.name }}</div>
                    <div class="price">{{ formatPrice(item.total) }}</div>
                </div>
                <div class="created_date">{{ formatDate(item.created) }}</div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name:'ListAllprojects',
    data(){
        return {

        }
    },
    props:{
        list: {
            type: Array,
            default: [],
        }
    },
    computed:{
        listSort(){
            return this.list.sort((a,b)=>{
                a = a.created; b = b.created
                if (a > b) return 1;
                if (a == b) return 0;
                if (a < b) return -1;
            })
        }
    },
    emits:['openProject', 'showProject'],
    methods:{
        formatPrice(price){
            return `€ ${Math.fround(price).toLocaleString("de-DE")}`
        },
        formatDate(date){
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
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

.list_all_projects{
    width: 60%;
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

.list{
    overflow-y: auto;
    max-height: 250px;
    scrollbar-color: #7E7E7E #EDEDED;
    scrollbar-width: thin;
}



.item{
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
    align-items: center;
    cursor: pointer;
}


.name_price{
    width: 70%;
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

.price{
    color: #c5c5c5;
    font-family: 'Comfortaa-Regular';
    font-size: 10px;  
}

.created_date{
    color: #c5c5c5;
    font-family: 'Comfortaa-Regular';
    font-size: 14px;    
    margin-right: 15px;
}

.item:hover{
    background-color: #EBAA6C;
    padding-left: 5px;
}

.item:hover .name{
    color:#fff;
}

.item:hover .price{
    color:#fff;
}

.item:hover .created_date{
    color:#fff;
}


</style>