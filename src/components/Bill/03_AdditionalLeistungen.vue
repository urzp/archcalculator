<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">II.<span>Zusätzliche Leistungen</span></div>
        </div>
        <div class="list">
            <div class="content item_list light-text">
                <div class="colum colum_1">Name</div>
                <div class="colum colum_2">10</div>
                <div class="colum colum_3">100</div>
                <div class="colum colum_4">1000</div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
        </div>
    </div>  
</template>

<script>
export default{
    name: 'AdditionalLeistungen',


}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
    }


    .light-text{
        font-family: 'Raleway-Light';
        color: #464646;
    }

    .bold-text{
        font-family: 'Raleway-Medium';
        color: #2c2c2c;       
    }

    .header_item{
        border-top: 1px solid #999;
        border-bottom: 1px solid #999;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .title span{
        margin-left: 10px;
    }

    .list{
        margin-left: 30px;
    }

    .item_list{
        display: flex;
        margin-bottom: 15px;
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