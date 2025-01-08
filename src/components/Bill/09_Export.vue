<template>
    <div class="wrap_panel">
        <div class="export_panel">
            <div @click="loadExsel" class="icon"><img src="@/assets/icons/exports/xls.png" alt=""></div>
            <div @click="loadPdf" class="icon"><img src="@/assets/icons/exports/pdf.png" alt=""></div>
            <div @click="showLinks" class="icon"><img src="@/assets/icons/exports/link.svg" alt=""></div>
        </div>
    </div>
</template>

<script>
import { Bills, saveBill, setPaid } from '@/servis/projectBill.js'
import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'
export default {
    name:'ExportPanel',
    data(){
        return {

        }
    },
    props:{
        bill_item:[Number, String]
    },
    computed:{
        actualBill(){
            let result = {}
            if(!!Bills&&Bills.length>0) result = Bills[this.bill_item]
            return result
        },
    },
    methods:{
        async loadExsel(){
            let downLoad_token = (await apiData({typeData:'DownloadURL', id:this.actualBill.id})).downLoad_token
            window.location.href = `https://honorar.online/download.php?bill=${this.actualBill.id}&downLoad_token=${downLoad_token}&type=excel`
        },
        async loadPdf(){
            let downLoad_token = (await apiData({typeData:'DownloadURL', id:this.actualBill.id})).downLoad_token
            window.location.href = `https://honorar.online/download.php?bill=${this.actualBill.id}&downLoad_token=${downLoad_token}&type=pdf`
        },
        async showLinks(){
            EventBus.emit('Popap:downloadLinks', this.actualBill.id)
        }
    }

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

