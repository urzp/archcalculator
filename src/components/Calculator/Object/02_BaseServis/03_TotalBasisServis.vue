<template>
    <div class="total-part-obj" :class="{collapse:collapse}">
        <div class="wrap" :class="{line:!collapse}">
            <div class="title">{{ text.Summe }}</div>
            <div class="value-percent">{{ percent }} %</div>
            <Price :value = 'value'/>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text.js'
export default{
    name: 'TotalBasisServis',
    async mounted(){

    },
    data(){
        return{
            text:{
                Summe: text.Calc.Summe,
            }
        }
    },
    props:{
        percent:Number,
        value:Number,
        collapse:Boolean,
    },
    watch:{

    },
    methods:{

    }
}
</script>
    
<style scoped>
.total-part-obj{
    display: flex;
    justify-content: flex-end;
    margin-top: 30px;
    margin-right: 40px;
}

.total-part-obj .wrap{
    display: flex;
    justify-content: flex-end;
    column-gap: 15px;
    font-family: 'Raleway-Regular';
    font-size: 20px;
    color: var(--color-akcent);
    align-items: baseline;
}
.value-percent{
    font-family: 'DroidSans';
}
.wrap.line{
    border-top: solid 1px var(--color-akcent);
}

.total-part-obj.collapse{
    margin-top: 0px;
}
</style>