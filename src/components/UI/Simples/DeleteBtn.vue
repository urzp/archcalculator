<template>
    <div class="delete-btn" :class="{whith_border:!no_border}">
        <img v-if="!icon_cross" src="@/assets/icons/btn_delete/main.svg" alt="">
        <img v-else src="@/assets/icons/btn_close/main.svg" alt="">
    </div>
</template>

<script>
export default{
    name: 'DeleteButton',
    props:{
        width:{
            type:String,
            default: '55px',
        },
        width_img:{
            type:String,
            default: '18px',
        },
        heigth:{
            type:String,
            default: '45px',
        },
        icon_cross:{
            type:Boolean,
            default: false,
        },
        no_border:{
            type:Boolean,
            default: false,
        }
    }
}
</script>

<style scoped>
    .delete-btn{
        min-width: v-bind(width);
        min-height: v-bind(heigth);
        padding-left: 15px;
        padding-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .whith_border{
        border: solid 1px #9A9A9A ;
        background-color: #fff;
        border-radius: 5px;
    }

    .delete-btn img{
       width: v-bind(width_img);
    }
</style>