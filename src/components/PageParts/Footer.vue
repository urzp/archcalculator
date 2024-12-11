<template>
<div class="footer-wrap">
    <div class="line-wrap"><div class="line"></div></div>
    <div class="list">
        <div class="item">Copyright © 2024 honorar.online</div>
        <div class="item">Impressum Datenschutz Cookie Einstellungen</div>
        <div class="item">mail@honorar.online</div>
        <div class="item whatsapp"></div>
    </div>
</div>
</template>

<script>
export default{
    name: 'Footer',
}
</script>

<style scoped>
    .line-wrap{
        position: absolute;
        left: 0px;
        width: 100%;
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