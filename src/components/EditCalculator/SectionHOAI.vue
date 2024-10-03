<template>
    <div class="wrap">
        <div class="label">Paragraph:</div>
        <div class="paragraph-name" >{{ data.name }}</div>
        <div class="paragraph-title" >{{ data.title }}</div>
        <Select_List  right :data='data' />
    </div>
</template>

<script>
export default{
    name: 'SectionHOAI',
    data(){
        return{
            data:{
                id:'',
                name:'§39',
                title:'Freianlagen',
                list:{
                    
                }
            }
        }
    }

}
</script>
<style scoped>
    .wrap{
        margin-top: 30px;
        min-height: 75px;
        display: flex;
        align-items: center;
        column-gap: 15px;
        font-family: 'Raleway-Light';
        font-size: 20px;
    }

    .paragraph-name, .paragraph-title{
        font-family: 'Raleway-Medium';
    }
</style>