<template>
    <div class="wrap">
        <div class="title">Paragraph:</div>
        <div class="active-paragraph" >{{ data.name }}</div>
    </div>
</template>

<script>
export default{
    name: 'SectionHOAI',
    data(){
        return{
            data:{
                name:'§39',
                title:'Freianlagen',
            }
        }
    }

}
</script>
<style scoped>
    .wrap{
        margin-top: 30px;
    }

    .title{
        font-family: 'Raleway-Light';
        font-size: 20px;
    }
</style>