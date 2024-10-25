<template>
    <div class="calculator">
        <div class="title-project">
            <div class="name">Project X</div>
            <div class="date">23.08.2024</div>
        </div>
        <div class="objects-calculator" v-for="item in ListObjects" :key="item.id">
            <ObjectCalc :object_id="item.id" :project_id="project"/>
        </div>
        <TotalCalc/>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'Calculator',
    mounted(){
        this.getData()
    },
    data(){
        return{
            project: '1',
            ListObjects:[{id:'1'}],
        }
    },
    methods:{
        async getData(){
            let result = (await apiData({typeData:'getProject', data:{id:this.project}})).data
        }
    }
}
</script>

<style scoped>
    .calculator{
        min-height: 75vh;
    }

    .title-project{
        margin-top: 60px;
        text-align: center;
    }
    .title-project .name{
        font-family: 'Raleway-Light';
        font-size: 36px;
    }
    .title-project .date{
        font-family: 'Comfortaa-Regular';
        font-size: 16px;
        color:#999999
    }
</style>