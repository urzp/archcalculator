<template>
    <div class="header">
        <div class="header-row">
            <div class="logo"><img src="@/assets/imgs/logo.svg" alt=""></div>
            <div class="menu">
                <div class="item_menu">About project</div>
                <div class="item_menu">How to use</div>
            </div>
            <div class="btn_menu"></div>
        </div>
        <div class="sub-header">
            <div class="item_subHeader">New Project</div>
            <div class="item_subHeader">Open Project</div>
        </div>
    </div>
</template>


<script>
export default{
    name: 'Header',
}
</script>


<style scoped>
    .header-row{
        height: 110px;
        display: flex;
        align-items: center;
        border-bottom: solid 1px #999999;
    }
    .menu{
        width: 100%;
        margin-right: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        column-gap: 100px;
    }
    .logo{
        cursor: pointer;
    }
    .menu .item_menu{
        font-family: 'Raleway-ExtraLight';
        font-size: 16px;
        cursor: pointer;
        transition: var(--transition-hover);
    }
    .menu .item_menu:hover{
        color: var(--color-akcent);
        font-family: 'Raleway-Light';
        transition: var(--transition-hover);
    }
    .btn_menu{
        width: 50px;
        height: 30px;
        cursor: pointer;
        background-image: url('@/assets/icons/btn_menu/main.svg');
        background-repeat: no-repeat;
        transition: var(--transition-hover);
    }

    .btn_menu:hover{
        background-image: url('@/assets/icons/btn_menu/active.svg');
        transition: var(--transition-hover);
    }

    .sub-header{
        margin-top: 15px;
        display: flex;
        column-gap: 50px;
        font-size: 'Raleway-ExtraLight';
        font-size: 16px;
        color: #999999;
        cursor:pointer;
    }

</style>