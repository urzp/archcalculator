<template>
    <div class="wrap_filter">
        <div class="buttons">
            <UpButton :width="'20px'" :heigth="'25px'"/>
            <DownButton :width="'20px'" :heigth="'25px'"/>
        </div>
        <div class="v_line"></div>
        <img src="@/assets/icons/filter/main.svg" alt="">
        <div class="input">
            <InputText :width="'300px'"/>
        </div>
    </div>
</template>

<script>
export default{
    name:'FilterData',
    data(){
        return{

        }
    }
}
</script>

<style scoped>
    .wrap_filter{
        position: absolute;
        transform: translateY(-70px);
        padding: 4px;
        display: flex;
        column-gap: 5px;
        border-radius: 3px;
        border: 1px solid #929292;
    }
    .buttons{
        display: flex;
        column-gap: 5px;
    }
    .v_line{
        border-right: 1px solid #929292;
    }
    img{
        margin-right: 15px;
    }
</style>