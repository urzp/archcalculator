<template>
    <div class="wrap">
        <div class="ql-editor" v-html="content" ></div>
    </div> 
</template>

<script>
import { apiData } from '@/servis/apiData.js'

export default {
    name: 'PageInf',
    mounted(){
        //this.init('impressum')
    },
    data(){
        return{
            content:'',
        }
    },
    methods:{
        async init(name){
            let data = await apiData({typeData:'PagesInfRead', name})
            this.content = data.data.content
        },
    },
    props:{
        namePage:String,
    },
    watch:{
        namePage(){
            this.init(this.namePage)
        }
    }
}

</script>
    
<style scoped>
    .wrap{
        font-family: 'Raleway-Regular';
    }

</style>