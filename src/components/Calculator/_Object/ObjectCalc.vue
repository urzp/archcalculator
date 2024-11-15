<template>
    <div class="object-calc" :class="{collapse}">
        <Titile_Object :object_id="object_id" @switch_tg="(val)=>{collapse = !val}"/>
        <Toggle :collapse="collapse">
        <Basis :object_id="object_id" />
        <BaseServis  :object_id="object_id" />
        <SpecialServices  :object_id="object_id" />
        </Toggle>
        <Total_Object :collapse="collapse" :object_id="object_id" />
    </div> 
    
</template>

<script>
export default{
    name: 'ObjectCalc',
    async mounted(){

    },
    data(){
        return{
            collapse: false,
        }
    },
    props:{
        object_id:[String, Number],
    },
    methods:{
    }
}
</script>

<style scoped>
    .object-calc{
        margin-top: 50px;
        margin-bottom: 90px;
        
    }

    .collapse{
        margin-bottom:0px;
    }

    .item{
        min-height: 100px;
    }
</style>