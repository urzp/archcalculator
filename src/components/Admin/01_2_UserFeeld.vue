<template>
    <div class="wrap_feeld">
        <div class="title">{{ title }}</div>
        <div class="value">{{ value }}</div>
    </div>
</template>

<script>

export default{
    name: 'UserFeeld',
    props:{
        title:{
            type:String,
            default:'',
        },
        value:{
            type:String,
            default:'',           
        },
        width:{
            type:String,
            default: '400px',
        }
    },
}

</script>


<style scoped>
.wrap_feeld{
    font-family: 'Raleway-Light';
    font-size: 20px;
    display: flex;
    column-gap: 10px;
}


.title{
    color: #929292;
}

.value{
    color: #010101;
}

</style>