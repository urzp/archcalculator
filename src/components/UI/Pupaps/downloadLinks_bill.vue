<template>
    <div v-if="show" class="wrap_pupap downloadLinks_bill">
        <div class="pupap">
            <div class="closeBtn" @click="close()"><img src="@/assets/icons/btn_close/main.svg" alt=""></div>
            <div class="form">
                <div class="title">{{ title }}</div>
                <div class="links">
                    <div class="wrap_link">
                        <div class="link_title">Excel:</div>
                        <div ref="mylink" class="link excel" @click="event=>selectText(event)">{{ excel_link }}</div>
                        <div class="link_a"><a :href="excel_link">download</a></div>
                    </div>
                    <div class="wrap_link">
                        <div class="link_title">PDF:</div>
                        <div class="link pdf" @click="event=>selectText(event)">{{ pdf_link }}</div>
                        <div class="link_a"><a :href="pdf_link">download</a></div>
                    </div>
                </div>
                <div class="message">{{ message }}</div>
            </div>
        </div>
    </div>
    <div v-if="show" @click.stop="close()" class="bg_for_close"></div>   
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'downloadLinks_bill',
    mounted(){
        EventBus.on('Popap:downloadLinks_bill',(id_bill)=>{this.openPopap(id_bill)})
    },
    data(){
        return {
            title:'Download links',
            excel_link:'',
            pdf_link:'',
            message:' ',
            timer:'',
            show:false,
            action:()=>{},
        }
    },
    methods:{
        close(){
            this.show=false
        },
        async openPopap(id_bill){
            this.show=true
            let downLoad_token = (await apiData({typeData:'DownloadURL', id:id_bill})).downLoad_token
            this.excel_link = `https://honorar.online/download.php?bill=${id_bill}&downLoad_token=${downLoad_token}&type=excel`;
            this.pdf_link = `https://honorar.online/download.php?bill=${id_bill}&downLoad_token=${downLoad_token}&type=pdf`
        }, 
        comfirm(){
            this.action()
            this.close()
        },
        showMessage(){
            clearTimeout(this.timer)
            this.message = 'Link kopiert'
            this.timer = setTimeout(()=>{this.message=' '}, 2000)
        },
        selectText(event) {
            let element = event.target
            if (document.selection) { // IE
                var range = document.body.createTextRange();
                range.moveToElementText(element);
                range.select();
                document.execCommand("copy");
            } else if (window.getSelection) {
                var range = document.createRange();
                range.selectNode(element);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
            }
            this.showMessage()
        }

    }

}
</script>

<style scoped>
    .wrap_pupap{
        position: relative;
        z-index: 50;
    }
    .pupap{
        position: fixed;
        left: calc(100% / 2 - 800px / 2);
        top: calc(100vh / 2 - 260px / 2);
        width: 800px;
        min-height: 30px;
        background-color: #fff;
        border: 2px solid #D9D9D9;
        border-radius: 10px;
        box-shadow: 4px 4px 4px #00000033;
    }

    .closeBtn{
        position: absolute;
        right: 7px;
        top: 7px;
        cursor: pointer;
    }

    .form{
        margin: 25px 35px;
        display: flex;
        flex-direction: column;
        row-gap: 5px;
        color: #464646;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .title{
        margin: 20px 0px;
        text-align: center;
    }

    .panel{
        display: flex;
        justify-content: flex-end;
        column-gap: 15px;
        font-size: 18px;
    }


    .bg_for_close{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color:#0000003b;
        z-index: 10;
    }

    .links{
        font-size: 16px;
        margin-bottom: 20px;
    }

    .wrap_link{
        display: flex;
        column-gap: 15px;
        align-items: baseline;
    }

    .link_title{
        width: 40px;
    }

    .link{
        width: 700px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color:#7c7c7c;
        font-size: 14px;
    }

    .message{
        font-size: 16px;
        min-height: 26px;
    }

</style>