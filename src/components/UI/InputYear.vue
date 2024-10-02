<template>
    <input ref="thisinput" type="text" class="year">
</template>

<script>
export default{
    name: 'InputYear',
    props:{
        focus:Boolean,
    },
    watch:{
        focus(n_val,o_val){
            if(n_val){
                console.log(this.$refs.thisinput)
                this.$refs.thisinput.focus();
            }
        }
    }
}
</script>

<style scoped>
    input{
        height: 45px;
        width: 150px;
        border-radius: 5px;
        background-color: #ebebeb;
        text-align: center;
        font-size: 20px;
        font-family: 'Raleway-Light';
        color: #464646;
    }
</style>