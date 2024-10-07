<template>
    <div class="wrap">
        <div class="title">Honorar Table</div>
        <div class="table">
            <div class="colum-project-size-value">
                <div class="header">
                    Anrechenbare Kosten
                    <div class="type-value">
                        <div>{{ project_type_value.value }}</div>
                        <Select_List :data="project_type_value" right @selected="data=>selectTypeValue(data)"/>
                    </div>
                </div>
                <div class="row-rate-value">200 000</div>
                <div class="row-rate-value">275 000</div>
                <NewButton style="margin-top: 10px;" width="35px" heigth="30px"/>
            </div>
            <div class="header honorar-zones">
                <div class="honorar-zone">Honorarzone I</div>
                <div class="honorar-zone">Honorarzone II</div>
                <div class="honorar-zone">Honorarzone III</div>
                <div class="honorar-zone">Honorarzone IV</div>
                <div class="honorar-zone">Honorarzone V</div>
                <NewButton style="margin-left: 10px;" width="35px" heigth="30px"/>
            </div>
        </div>

    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'FeeTable',
    data(){
        return{
            project_type_value:{
                value:'Eur',
                list:[
                    {id:1,value:"Eur"},
                    {id:1,value:"Hektar"},
                ]
            }
        }
    },
    methods:{
        selectTypeValue(data){
            this.project_type_value.value = data.value
        }
    }

}
</script>

<style scoped>
    .wrap{
        margin-top: 30px;
    }

    .title{
        font-family: 'Raleway-Light' ;
        font-size: 20px;
    }

    .table{
        margin-top: 20px;
        height: 50px;
        display: flex;
        column-gap: 30px;
        font-family: 'Raleway-Regular' ;
        font-size: 18px;
    }

    .header{
        height: 30px;
        display: flex;
        column-gap: 10px;
        align-items: center;
    }

    .type-value{
        display: flex;
        column-gap: 10px;
        align-items: center;
    }

    .honorar-zones{
        display: flex;
        column-gap: 30px;
    }

    .colum-project-size-value{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .row-rate-value{
        margin-top: 5px
    }

</style>