<template>
    <div class="toggle_btn" :class="{closed:!this.open}" @click="switch_tg()"></div>
</template>

<script>
export default{
    name: 'ToggleButton',
    data(){
        return{
            open: true,
        }
    },
    methods:{
        switch_tg(){
            this.open = !this.open
            this.$emit('switch_tg', this.open)
        }
    },
    emits: ['switch_tg'],

}
</script>

<style scoped>
    .toggle_btn{
        width: 12px;
        height: 10px;
        background-image: url('@/assets/icons/toggle_btn/opend.svg');
        background-repeat: no-repeat;
        background-position: center;
        cursor: pointer;
    }
    .toggle_btn.closed{
        background-image: url('@/assets/icons/toggle_btn/closed.svg');
    }
</style>

