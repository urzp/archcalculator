<template>
    <div class="object-calc">
        <Titile_Object @switch_tg="(val)=>{collapse = !val}"/>
        <Toggle :collapse="collapse">
        <Basis :object_id="object_id" :loaded="loaded"/>
        <BaseServis  :object_id="object_id" :loaded="loaded"/>
        <SpecialServices  :object_id="object_id" :loaded="loaded"/>
        </Toggle>
        <Total_Object :collapse="collapse" :object_id="object_id" :loaded="loaded"/>
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
        loaded:Boolean,
        project_id:String,
        object_id:String,
    },
    methods:{
    }
}
</script>

<style scoped>
    .object-calc{
        margin-top: 50px;
        margin-bottom: 90px;
        min-height: 500px;
    }

    .item{
        min-height: 100px;
    }

</style>