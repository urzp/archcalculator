<template>
    <div class="wrap">
        <HOAIVersion @selected="data=>update(data)"/>
        <SectionHOAI />
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'EditCalculator',
    mounted(){
        
    },
    data(){
        return{
            data:{},
        }
    },
    methods:{
        update(data){
            let result  = apiData({typeData:'getHOAI', data: data.id_item})
            this.data = result
        }
    }


}
</script>

<style scoped>
    .wrap{
        min-height: 75vh;
    }

</style>