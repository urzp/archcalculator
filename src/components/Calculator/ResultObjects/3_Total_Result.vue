<template>
    <div class="total" :class="{collapse}">
        <div class="wrap">
            <div class="title-total" :class="{collapse}">{{ nameObject }}</div>
            <div class="data-total">
                <div class="label">Total</div>
                <!-- <div class="procent">100%</div> -->
                <Price class="price" :value = "value" font_size_unit="24px" font_size_cent="18px" :font_family="font_family"/>
            </div>
        </div>
    </div>  
</template>

<script>
import { Project } from '@/servis/projectData.js'
export default{
    name: 'Total_Result',
    mounted(){
        this.getProject()
    },
    data(){
        return{
            font_family:'Comfortaa-Regular',
            project:{},
        }
    },
    props:{
        object_id:String,
        loaded:String,
        collapse:Boolean,
    },
    watch: {
        collapse(newVal){
            this.font_family = newVal?'Comfortaa-Light':'Comfortaa-Regular'
        },
    }, 
    computed:{
        value(){
            return 0
        },
        nameObject(){
            return ''
        }
    },
    methods:{
        getProject(){
           
        }
    }
}
</script>

<style scoped>
    .total{
        height: 110px;
        display: flex;
        justify-content: flex-end;
        background-color: #F5F5F5;
        border-left: solid 1px #C0C0C0;
        font-size: 24px;
        color: var(--color-akcent);
    }
    .total .wrap{
        margin-right: 40px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
    }
    .data-total{
        display: flex;
        align-items: baseline;
        column-gap: 15px;
        border-top: solid 1px var(--color-akcent);
    }

    .title-total, .data-total .label{
        font-family: 'Raleway-Regular';
    }

    .data-total .procent{
        font-family: 'Comfortaa-Medium';
    }

    /* ------------------ collapse ------------------- */

    .total.collapse{
        position: relative;
        height: 0px;
        top: -55px;
        left: -36px;
        background-color: transparent;;
        border: none;
        color: #8b8b8b;
        pointer-events: none;
    }

    .title-total.collapse{
        display: none;
    }

    .collapse .data-total{
        
        border: none;
    }

    .collapse .data-total .label{
        font-family: 'Raleway-Light';
    }

    .collapse .data-total .procent{
        font-family: 'Comfortaa-Light';
        color:#000000;
    }

    .collapse .price{
        color:#000000;
    }
</style>