<template>
    <div class="total Total_Object" :class="{collapse}">
        <div class="wrap">
            <div class="title-total" :class="{collapse}">{{ nameObject }}</div>
            <div class="data-total">
                <div class="label">{{ text.Summe }}</div>
                <!-- <div class="procent">100%</div> -->
                <Price class="price" :value = "value" font_size_unit="24px" font_size_cent="18px"/>
            </div>
        </div>
    </div>  
</template>

<script>
import { Project, updateProjectObject  } from '@/servis/projectData.js'
import { EventBus } from '@/servis/EventBus'
import { text } from '@/servis/text.js'
export default{
    name: 'Total_Object',
    mounted(){
        this.getProject()
    },
    data(){
        return{
            project:{},
            text:{
                Summe: text.Calc.Summe,
            }
        }
    },
    props:{
        object_id:[String,Number],
        collapse:Boolean,
    },
    watch: {
        collapse(newVal){
            this.font_family = newVal?'Comfortaa-Light':'Comfortaa-Regular'
        },
    }, 
    computed:{
        value(){
            let result = Number(this.project.servis_total) + Number(this.project.spetial_servis_total)
            this.project.total_object = result
            updateProjectObject(this.object_id)
            return result
        },
        nameObject(){
            return this.project.name
        }
    },
    methods:{
        getProject(){
            this.project = Project.objects.find(item=>item.id==this.object_id)
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
        font-size: inherit;
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