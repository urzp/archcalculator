<template>
    <div class="honorar item_base_servis light-text">
        <div class="titile_item wrap_part">
            <div class="number">4.</div>
            <div class="title">Ermittlung Leistungsstand</div>
        </div>
        <div class="list">
            <div class="header item_list">
                <div class="colum colum_1">Leistungsphase</div>
                <div class="colum colum_2">beauftragt</div>
                <div class="colum colum_3">geleistet</div>
                <div class="colum colum_4">Faktor</div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="content item_list" v-for="item in list" :key="item.id">
                <div class="colum colum_1">{{ item.name }}</div>
                <div class="colum colum_2">
                    <Percent_Bill input_type 
                    :value = "selectPercent(item)" 
                    @edit_value = "procent=>setProcent(procent)"/>
                </div>
                <div class="colum colum_3">
                    <div class="colum colum_2">
                    <Percent_Bill input_type 
                    :value = "item.done" 
                    @edit_value = "procent=>setProcent(procent)"/>
                </div>
                </div>
                <div class="colum colum_4">{{ item.factor }}</div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="total item_list bold-text">
                <div class="colum colum_1">Summe</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'BillLeistungsstand',
    data(){
        return{

        }
    },
    props:{
        id_bill:[String,Number],
        honorar_object: Object,
    },
    computed:{
        list(){
            let result = []
            if(!!this.honorar_object&&!!this.honorar_object.stages) result = this.honorar_object.stages
            return result
        }        
    },
    methods:{
        selectPercent(item){
            if(item.user_percent!='') return item.user_percent
            return item.percent
        }
    }

}
</script>



<style scoped>

    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .wrap_part{
        display: flex;
        column-gap: 15px;
    }

    .item_base_servis{
        display: flex;
        flex-direction: column;
        column-gap: 15px;
        justify-content: space-between;
    }

    .list{
        margin-top: 20px;
        margin-left: 30px;
        margin-bottom: 20px;
    }

    .header{
        border-bottom: 1px solid #999;
        margin-bottom: 5px;
    }

    .total{
        border-bottom: 1px solid #999;
        margin-bottom: 5px;
    }

    .item_list{
        display: flex;
    }

    .colum_1{
        width: 43%;
    }
    .colum_2{
        width: 11%;
        text-align: center;
    }
    .colum_3{
        width: 11%;
        text-align: center;
    }
    .colum_4{
        width: 11%;
        text-align: center;
    }
    .colum_5{
        width: 12%;
    }
    .colum_6{
        width: 12%;
    }

    .content .colum_1{
        font-size: 16px;
    }

    .content .colum_2 {
        font-size: 16px;
    }
</style>
