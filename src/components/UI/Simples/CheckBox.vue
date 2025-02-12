<template>
    <div class="checkbox" @click="check()">
        <img v-if="!!Number(checked)" src="@/assets/icons/checkbox/true.svg" alt="">
        <img v-else src="@/assets/icons/checkbox/false.svg" alt="">
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

</style>