<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">IV.<span>Zwischensumme</span></div>
        </div>
        <div class="list">
            <div class="content item_list bold-text">
                <div class="colum colum_1">1. Zwischensumme Netto-Honorare einschließlich Nebenkosten</div>
                <div class="colum colum_2"> 19 326,23 € </div>
            </div>
            <div class="content item_list bold-text">
                <div class="colum colum_1">2. Umsatzsteuer   19%</div>
                <div class="colum colum_2"> 3 671,98 € </div>
            </div>
            <div class="content item_list bold-text">
                <div class="colum colum_1">3. Brutto-Honorar einschließlich Nebenkosten</div>
                <div class="colum colum_2"> 22 998,22 € </div>
            </div>
        </div>
    </div>  
</template>

<script>
export default{
    name: 'Zwischensumme',


}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
    }

    .content{
        margin-left: 15px;
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
        margin-bottom: 15px;
    }

    .item_list{
        display: flex;
    }

    .colum_1{
        width: 89%;
    }
    .colum_2{
        width: 11%;
        text-align: center;
    }

</style>