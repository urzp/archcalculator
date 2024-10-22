<template>
    <div class="main_row">
        <div class="title">HOAI version</div>
        <div class="value">{{ 2021 }}</div>
        <div  class="select-list" >
            <Select_List :data="data"/>
        </div>
    </div>
</template>

<script>
export  default{
    name: 'HOAI_version',
    data(){
        return{
            data:{
                list:[
                    {id:1, value:'2021'}
                ],
            }
        }
    }
}
</script>

<style scoped>
    .main_row{
        display: flex;
        height: 35px;
        align-items: center;
        justify-content: space-between;
    }   
    .title{
        margin-left: 55px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
    .value{
        font-family: 'Raleway-Light';
        font-size: 18px;
        color:#464646;
        margin-left: auto;
    }
    .select-list{
        margin-left: 20px;
        margin-right: 10px;
    }
</style>