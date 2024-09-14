<template>
    <div class="toggle_list_btn" :class="{closed:!this.open}" @click="switch_tg()"></div>
</template>

<script>
export default{
    name: 'ToggleListButton',
    data(){
        return{
            open:false,
        }
    },
    props:{
        close:Boolean,
    },
    methods:{
        switch_tg(){
            this.open = !this.open
            this.$emit('switch_tg', this.open)
        }
    },
    watch:{
        close(){
            this.open = !this.close
        }
    },
    emits: ['switch_tg'],
}
</script>

<style scoped>
    .toggle_list_btn{
        width: 12px;
        height: 10px;
        background-image: url('@/assets/icons/toggle_btn/opend.svg');
        background-repeat: no-repeat;
        background-position: center;
        cursor: pointer;
    }
    .toggle_list_btn.closed{
        background-image: url('@/assets/icons/toggle_btn/closed.svg');
    }
</style>


