<template>
<div class="footer-wrap">
    <div class="line-wrap"><div class="line"></div></div>
    <div class="collums">
        <div class="collum collum_1">
            <div class="logo"><img src="@/assets/imgs/logo.svg" alt=""></div>
            <div class="social">
                <div class="social_item"><img src="@/assets/icons/social_network/instagram/main.svg" alt=""></div>
                <div class="social_item"><img src="@/assets/icons/social_network/twitter/main.svg" alt=""></div>
                <div class="social_item"><img src="@/assets/icons/social_network/linkedin/main.svg" alt=""></div>
                <div class="social_item"><img src="@/assets/icons/social_network/facebook/main.svg" alt=""></div>
                <div class="social_item"><img src="@/assets/icons/social_network/youtube/main.svg" alt=""></div>
            </div>
        </div>
        <div class="collum collum_2">
            <div class="row_link">{{ text.Impressum }}</div>
            <div class="row_link">{{ text.Datenschutz }}</div>
            <div class="row_link">{{ text.Cookie_Einstellungen }}</div>
            <div class="row_link">{{ text.Contact }}</div>
        </div>
        <div class="collum collum_3">
            <div class="row_link">{{ text.Abaut }}</div>
            <div class="row_link">{{ text.Instructions }}</div>
            <div class="row_link">{{ text.HOAI }}</div>
            <div class="row_link">{{ text.Calculate_the_fee_correctly }}</div>
            <div class="row_link">{{ text.Blog }}</div>
        </div>
    </div>
    <div class="copy_right">{{ text.Copyright }}</div>
</div>
</template>

<script>
import { text } from '@/servis/text.js'
export default{
    name: 'Footer',
    data(){
        return{
            text:{
                Copyright: text.footer.Copyright,
                Impressum: text.footer.Impressum,
                Datenschutz: text.footer.Datenschutz,
                Cookie_Einstellungen: text.footer.Cookie_Einstellungen,
                Contact: text.footer.Contact,
                Abaut:text.footer.Abaut,
                Instructions: text.footer.Instructions,
                HOAI: text.footer.HOAI,
                Calculate_the_fee_correctly: text.footer.Calculate_the_fee_correctly,
                Blog: text.footer.Blog,
            },
        }
    }

}
</script>

<style scoped>
    .line-wrap{
        position: absolute;
        left: 0px;
        width: 100%;
        z-index: 10;
    }
    .line{
        margin-left: 1%;
        margin-right: 1%;
        border-bottom: solid 1px #999999;
    }
    .footer-wrap{
        margin-top: 100px;
        margin-bottom: 0px;
    }
    .collums{
        height: 100%;
        padding-top: 20px;
        padding-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;

    }

    .collum, .copy_right{
        font-family: 'Comfortaa-Regular';
        font-size: 16px;
        color: #464646;
        cursor: pointer;
        transition: var(--transition-hover);
        flex-direction: column;
        display: flex;
    }

    .collum_1{
        width: 40%;
        align-items: center;
    }

    .logo img{
        height: 24px;
    }

    .social{
        display: flex;
        column-gap: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .social img{
        height: 24px;
    }

    .collum_2{
        align-items:start;
    }

    .whatsapp{
        height: 100%;
        width: 33px;
        background-image: url('@/assets/icons/whatsApp/main.svg');
        background-repeat: no-repeat;
        background-position: center;
        transition: var(--transition-hover);
    }

    .whatsapp:hover{
        background-image: url('@/assets/icons/whatsApp/active.svg');
        transition: var(--transition-hover);
    }

    .copy_right{
        width: 40%;
        text-align: center;
        margin-top: -43px;
        margin-bottom: 50px;
        font-size: 14px;
    }
</style>