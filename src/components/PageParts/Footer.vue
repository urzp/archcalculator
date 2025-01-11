<template>
<div class="footer-wrap">
    <div class="line-wrap"><div class="line"></div></div>
    <div class="list">
        <div class="item">{{ text.Copyright }}</div>
        <div class="item">{{ text.Privacy_Policy }}</div>
        <div class="item">{{ text.mail }}</div>
        <div class="item whatsapp"></div>
    </div>
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
                Privacy_Policy: text.footer.Privacy_Policy,
                mail:text.footer.mail,
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
        height: 90px;
    }
    .list{
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .item{
        font-family: 'Comfortaa-Regular';
        font-size: 16px;
        color: #464646;
        cursor: pointer;
        transition: var(--transition-hover);
    }

    .item:hover{
        color: var(--color-akcent);
        transition: var(--transition-hover);
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
</style>