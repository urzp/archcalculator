<template>
    <div class="object-calc">
        <Titile_Object :object_id="object_id" @switch_tg="(val)=>{collapse = !val}"/>
        <Toggle :collapse="collapse">
        <Basis :object_id="object_id" :loaded="loaded"/>
        <BaseServis  :object_id="object_id" :loaded="loaded"/>
        <SpecialServices  :object_id="object_id" :loaded="loaded"/>
        </Toggle>
        <Total_Object :collapse="collapse" :object_id="object_id" :loaded="loaded"/>
        <div class="panel">
            <NewButton width="140px">Object</NewButton>
            <CloseButton />
        </div>
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

    .panel{
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
        column-gap: 15px;
        font-family: 'Raleway-Light';
        color: #929292;
        font-size: 20px;
    }

</style>