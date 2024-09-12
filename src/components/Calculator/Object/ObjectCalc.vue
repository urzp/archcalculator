<template>
    <div class="object-calc">
        <ObjectTitile @switch_tg="(val)=>{collapse =  !val}"/>
        <Toggle :collapse="collapse">
        <Basis/>
        <BaseServis/>
        </Toggle>
        <ObjectTotal :collapse="collapse"/>
    </div> 
    
</template>

<script>

export default{
    name: 'ObjectCalc',
    data(){
        return{
            collapse: false,
        }
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