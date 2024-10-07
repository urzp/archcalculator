<template>
    <div class="wrap">
        <HOAIVersion @selected="data=>update(data)"/>
        <template v-if="!!selected_id">
            <ParagraphHOAI :id_HOAI="selected_id" />
            <FeeTable/>
        </template>
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
            selected_id:''
        }
    },
    methods:{
        update(data){
            this.selected_id = data.id_item
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