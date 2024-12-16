<template>
    <div class="honorar item_base_servis light-text">
        <div class="titile_item wrap_part">
            <div class="number">5.</div>
            <div class="title">Besondere Leistungen</div>
        </div>
        <div class="list">
            <div class="header item_list">
                <div class="colum colum_1">Sonderleistungen</div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
                <div class="colum colum_5"></div>
                <div class="colum colum_6"></div>
            </div>
            <div class="content item_list">
                <div class="colum colum_1"></div>
                <div class="colum colum_2"></div>
                <div class="colum colum_3"></div>
                <div class="colum colum_4"></div>
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
    name: 'BillBesondereLeistungen',


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
        margin-left: 30px;
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
