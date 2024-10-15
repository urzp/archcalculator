<template>
    <div class="wrap">
        <HOAIVersion @selected="data=>update(data)"/>
        <template v-if="!!selected_id">
            <ParagraphHOAI :id_HOAI="selected_id" :data_HOAI="data_HOAI"/>
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
            data_HOAI:{},
            selected_id:''
        }
    },
    methods:{
        async update(data){
            this.selected_id = data.id_item
            let result  = await apiData({typeData:'getHOAI', data: data.id_item})
            this.data_HOAI = result.data.find(item=>item.id==this.selected_id)
        }
    }


}
</script>

<style scoped>
    .wrap{
        min-height: 75vh;
        margin-bottom: 50px;
    }

</style>