<template>
    <div class="bills_wrap">
        <CalcTitle></CalcTitle>
        <BillsList></BillsList>
        <div class="title_bill">
            <div class="name">Bill:</div>
            <div class="devide_part"></div>
        </div>
        <BillHeader/>
        <BillBasicServices/>
    </div>
</template>


<script>

export default{
    name: 'Bill',


}
</script>

<style scoped>
    .title_bill .name{
        font-family: 'Raleway-Light';
        color: #3d3d3d;
        font-size: 24px;
        border-bottom: 1px solid #999999;
    }

    .devide_part{
        width: 100%;
        height: 40px;
        margin-top: 15px;
        margin-bottom: 10px;
        background-color: #F5F5F5;
    }

</style>