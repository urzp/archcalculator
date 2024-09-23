<template>
    <div class="wrap" >
        <div class="list">
            <div class="detal-item" v-for="item in data.list" :key="item.id">
                <div class="title">{{ item.title }}</div>
            </div>
        </div>
        <div class="total">

        </div>
    </div>
</template>

<script>
export  default{
    name: 'DetalsList',
    data(){
        return{
            collapse:true,
        }
    },
    props:{
        data: Object,
    }
}
</script>

<style scoped>
.wrap{
    display: flex;
    background-color: #fff;
    margin-left: 55px;
}
.wrap::before{
    position: relative;
    left: -25px;
    content: "";
    border-left: solid 1px #E4E4E4;
}
.detal-item{
    display: flex;
    color: #8E8E8E;
    font-family:'Raleway-Light';
    font-size: 20px;
}

</style>