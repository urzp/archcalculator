<template>
    <div class="wrap_marker">        
        <div v-if="Number(level)==0" class="wrap_icon"><img src="@/assets/icons/Marker_L_0/main.svg" alt=""></div>
        <div v-if="Number(level)==1" class="wrap_icon"><div class="point"></div></div>
    </div>
</template>

<script>
export default {
    name: 'Marker',
    data(){
        return{

        }
    },
    props:{
        level:[Number, String]
    }
}
</script>

<style scoped>
img{
    margin-bottom: 3px;
}
.wrap_marker, .wrap_icon{
    margin: auto 0;
}
.point{
        width: 8px;
        height: 8px;
        margin-bottom: 3px;
        background-color: #757575;
        border-radius: 4px;
    }
</style>