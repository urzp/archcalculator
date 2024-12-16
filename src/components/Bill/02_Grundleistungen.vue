<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">I.<span>Grundleistungen</span></div>
        </div>
        <div class="content">
            <div class="object">
                <div class="header item_base_servis">
                    <div class="wrap_part">
                        <div class="number bold-text">A.</div>
                        <div class="title bold-text">Honorarobjekt</div>
                    </div>
                    <div class="value bold-text">Parkhaus Neubau</div>
                </div>
                <BillBasicServices/>
                <BillLeistungsstand/>
                <BillBesondereLeistungen/>
            </div>
        </div>
    </div>  
</template>

<script>
export default{
    name: 'Grundleistungen',


}
</script>

<style scoped>
    .Grundleistungen{
        font-size: 18px;
    }

    .content{
        margin-left: 15px;
        margin-bottom: 15px;
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

    .object .header{
        display: flex;
        column-gap: 15px;
    }

    .wrap_part{
        display: flex;
        column-gap: 15px;
    }

    .item_base_servis{
        display: flex;
        column-gap: 15px;
        justify-content: space-between;
    }
</style>