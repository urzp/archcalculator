<template>
    <div class="Grundleistungen">
        <div class="header_item">
            <div class="title bold-text">Rechnungsbetrag</div>
        </div>
    </div>  
</template>

<script>
export default{
    name: 'Rechnungsbetrag',


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
</style>