<template>
    <div class="wrap_feeld">
        <div class="title">{{ title }}</div>
        <div class="input"><input type="password"  @change="event=>editValue(event.target.value)" autocomplete="off"></div>
        <div v-if="error_input" class="error">{{ error_msg }}</div>
        <div v-if="errNewPasswords" class="error">passen nicht zusammen</div>
    </div>
</template>

<script>
export default{
    name: 'EditPassword',
    mounted(){
       
    },
    data(){
        return {
            error_input:false,
            error_msg:'error',
        }
    },
    emits:['newValue'],
    props:{
        title:{
            type:String,
            default:'',
        },
        errNewPasswords:Boolean,
    },
    methods:{

        async editValue(value){
            this.error_input = false;
            if(value.length<3){
                this.error_input = true;
                this.error_msg = 'mindestens 3 Buchstaben'
                return false
            }
            this.setValue(value)
            return  true
        },
        async setValue(value){
            this.$emit('newValue', value)
        }

    }

}

</script>


<style scoped>
.title{
    font-family: 'Raleway-Light';
    font-size: 20px;
    color: #929292;
}


input{
    width: 400px;
    height: 45px;
    padding-left: 10px;
    padding-right: 10px;
    font-family: 'Raleway-Light';
    font-size: 20px;
    color: #5A5A5A;
    border-radius: 3px;
    background-color: #EFEFEF;
}

.wrap_feeld{
    margin-bottom: 5px;
}
.error{
    font-family: 'Raleway-Light';
    font-size: 18px;
    color: var(--color-akcent);   
}
</style>