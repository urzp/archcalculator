<template>
    <div class="item-sub-obj">
        <div class="title">{{ title }}</div>
    </div>
</template>

<script>
export  default{
    name: 'ItemSubObj',
    data(){
        return{
            title:'',
            collapse:true
        }
    },
    props:{
        title:String,
    },
}
</script>