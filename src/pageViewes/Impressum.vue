<template>
    <div class="wrap">
        <div v-html="content" ></div>
    </div> 
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default {
    name: 'Impressum',
    mounted(){
        this.init()
    },
    data(){
        return{
            content:'',
        }
    },
    methods:{
        async init(){
            let data = await apiData({typeData:'PagesInfRead', name:'impressum'})
            this.content = data.data.content
        },
    }
}

</script>
    
<style scoped>
    .wrap{
        font-family: 'Raleway-Regular';
    }

</style>