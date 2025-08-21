<template>
    <div class="total-part-obj" :class="{collapse:collapse}">
        <div class="wrap" :class="{line:!collapse}">
            <div class="title">{{ text.Total_Additional_Services }}</div>
            <Price :value = 'value'/>
        </div>
    </div>
</template>

<script>
import { text } from '@/servis/text';
export default{
    name: 'TotalAdditionalServis',
    async mounted(){

    },
    data(){
        return{
            text:{
                Total_Additional_Services: text.Calc.Total_Additional_Services,
            }
        }
    },
    props:{
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
.wrap.line{
    border-top: solid 1px var(--color-akcent);
}
.value-percent{
    font-family: 'DroidSans';
}
.total-part-obj.collapse{
    margin-top: 0px;
}
</style>