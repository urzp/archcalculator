<template>
    <div class="total" :class="{collapse}">
        <div class="wrap">
            <div class="title-total" :class="{collapse}">{{ nameObject }}</div>
            <div class="data-total">
                <div v-if="!billMode" class="label">{{ text.Summary }}</div>
                <div v-else class="label">{{ text.Summ_rest_payment_bill }}</div>
                <!-- <div class="procent">100%</div> -->
                <Price class="price" :value = "value" font_size_unit="24px" font_size_cent="18px" :font_family="font_family"/>
            </div>
        </div>
    </div>  
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Project } from '@/servis/projectData.js'
import { text } from '@/servis/text.js'
export default{
    name: 'Total_Result',
    mounted(){
        this.getProject()
    },
    data(){
        return{
            font_family:'Comfortaa-Regular',
            project:{},
            text:{
                Summary: text.Calc.Sum_total_calc,
                Summ_rest_payment_bill: text.Calc.Summ_rest_payment_bill,
            }
        }
    },
    props:{
        loaded:String,
        collapse:Boolean,
    },
    watch: {
        collapse(newVal){
            this.font_family = newVal?'Comfortaa-Light':'Comfortaa-Regular'
        },
    }, 
    computed:{
        billMode(){
            if(!this.project||!this.project.status||this.project.status!='bill') return false
            return true 
        },
        value(){
            if(this.billMode) return this.project.payment_total
            return this.project.total
        },
        nameObject(){
            return this.project.name
        },
    },
    methods:{
        getProject(){
            this.project = Project.project
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