<template>
    <div class="checkbox" @click="check()">
        <img  v-if="!!Number(checked)" src="@/assets/icons/checkbox/true.svg" alt="">
        <img  v-else src="@/assets/icons/checkbox/false.svg" alt="">
    </div>
    <div class="checkbox_hover" @click="check()">
        <img  v-if="!!Number(checked)" src="@/assets/icons/checkbox/true_white.svg" alt="">
        <img  v-else src="@/assets/icons/checkbox/false_white.svg" alt="">
    </div>
</template>

<script>
export default {
    name: 'CheckBox',
    data(){
        return{
            
        }
    },
    props:{
        checked:[Boolean, String, Number]
    },
    emits:['switch'],
    methods:{
        check(){
            this.$emit('switch', !Number(this.checked))
        }
    }
}
</script>

<style scoped>

.checkbox{
    display: flex;
    justify-content: center;
}

.checkbox img{
    width: 25px;
}


.checkbox_hover{
    display: none;
    justify-content: center;
}

.checkbox_hover img{
    width: 25px;
}

</style>