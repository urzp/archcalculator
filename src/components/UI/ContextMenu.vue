<template>
    <div v-if="show" class="contect-menu" :style="`left: ${data.positon.x}px; top: ${data.positon.y}px;`" >
        <div class="item" v-for="item in data.items" :key="item.id">
            {{ item.label }}
        </div>
    </div>
    <div v-if="show" @click.stop="close()" @contextmenu="$event.preventDefault(); close()" class="bg_for_close_list"></div>
</template>

<script>
export default{
    name: 'ContextMenu',
    data(){
        return{
            show:false,
        }
    },
    props:{
        data:Object,
        width:{
            type:String,
            default: '100px',
        },
        heigth:{
            type:String,
            default: '45px',
        }
    },
    watch:{
        data:{
            handler(){
                this.open()
            },
            deep:true,
        }
    },
    methods:{
        open(){
            this.show = true;
        },
        close(){
            console.log('close')
            this.show = false;
        },
    }
}
</script>


<style scoped>
    .contect-menu{
        /* min-width: v-bind(width);
        min-height: v-bind(heigth); */
        position: absolute;
        left:100px;
        top: 100px;
        padding: 5px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        background-color: #ffffff;
        border: solid 1px #D9D9D9;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 5px 5px 10px #979797;
        z-index: 100;
    }
    .item{
        cursor: pointer;
    }
    .bg_for_close_list{
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: transparent;
        z-index: 10;
    }
</style>