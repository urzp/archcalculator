<template>
    <div class="honorar item_base_servis light-text">
        <div class="titile_item wrap_part">
            <div class="title">2. Abzüge für geleistete Abschlagszahlungen</div>
        </div>
        <div class="list">
            <div class="header item_list">
                <div class="colum colum_1">RE0001</div>
                <div class="colum colum_2">Zahlung vom</div>
                <div class="colum colum_3">14.06.2023</div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"> 1 000,00 € </div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'AdvancePayments',


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

    .title{
        margin-left: 15px;
    }

    .list{
        margin-left: 45px;
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
</style>
