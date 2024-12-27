<template>
    <div class="wrap_panel">
        <div class="export_panel">
            <div class="icon"><img src="@/assets/icons/exports/xls.png" alt=""></div>
            <div class="icon"><img src="@/assets/icons/exports/pdf.png" alt=""></div>
            <div class="icon"><img src="@/assets/icons/exports/link.svg" alt=""></div>
        </div>
    </div>
</template>

<script>
export default {
    name:'ExportPanel',
    data(){
        return {

        }
    },
    props:{
        bill_item:[Number, String]
    },
}
</script>

<style scoped>
.wrap_panel{
    display: flex;
    justify-content: flex-end;
}

.export_panel{
    align-self: flex-end;
    width: 160px;
    border-top: 1px solid #e2e2e2;
    display: flex;
    column-gap: 10px;
    justify-content: flex-end;
}

.export_panel .icon{
    margin-top: 20px;
    width: 40px;
    height: 40px;
    cursor: pointer;
}

</style>

