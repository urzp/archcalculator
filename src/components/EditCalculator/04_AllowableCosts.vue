<template>
    <ContextMenu :data ="contextMenu" @action="updateListData()"/>
    <div class="wrap">
        <div class="title">Anrechenbare Kosten</div>


    </div>
</template>

<script>
export default{
    name:'AllowableCosts',
}

</script>

<style scoped>
    .wrap{
        margin-top: 30px;
    }

    .title{
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
</style>