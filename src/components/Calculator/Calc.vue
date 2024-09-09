<template>
    <div class="calculator">
        <div class="title-project">
            <div class="name">Project X</div>
            <div class="date">23.08.2024</div>
        </div>
        <ObjectCalc/>
        <TotalCalc/>
    </div>
</template>

<script>
export default{
    name: 'Calculator',
}
</script>

<style scoped>
    .calculator{
        min-height: 75vh;
    }

    .title-project{
        margin-top: 60px;
        text-align: center;
    }
    .title-project .name{
        font-family: 'Raleway-Light';
        font-size: 36px;
    }
    .title-project .date{
        font-family: 'Comfortaa-Regular';
        font-size: 16px;
        color:#999999
    }
</style>