<template>
    <div class="total_object">
        <div class="title">Summ as Honorarobjekt</div>
        <div class="summ">
            <Price :value="total" font_size_unit="18px" font_family="Raleway-Medium"/>
            </div>
    </div>
</template>

<script>
import { Project } from '@/servis/projectData.js'
import { Bills, saveBill, getCosts_ById } from '@/servis/projectBill.js'
export default{
    name: 'BillTotalObject',
    data(){
        return{

        }
    },
    props:{
        id_bill:[String,Number],
        honorar_object: Object,
    },
    computed:{
        stagesTotal(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.stagesTotal){
                result = this.honorar_object.stagesTotal
            }
            return result
        },
        extraTotal(){
            let result = 0
            if(!!this.honorar_object&&!!this.honorar_object.stagesExtraTotal) result = this.honorar_object.stagesExtraTotal
            return result
        },
        total(){
            let result = 0
            if(!!this.honorar_object){
                result = this.extraTotal + this.stagesTotal
                this.honorar_object.total = result
            }
            return result
        }
    }
}
</script>

<style scoped>
.total_object{
    display: flex;
    justify-content: space-between;
}
</style>

