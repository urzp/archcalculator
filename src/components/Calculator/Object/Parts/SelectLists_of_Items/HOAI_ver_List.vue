<template>
    <ToggleListButton :close="!open" @switch_tg="(val)=>{open=val}"/>
    <div v-if="open" class="wrap">
    <div class="list-HOAT-version">
        <ul>
            <li v-for="item in list" :key="item.id" @click="select_data(item.val)">{{ item.val }}</li>
        </ul> 
    </div>
    </div>
</template>

<script>
export default{
    
    name: 'SelList_HOAT_Ver',
    data(){
        return{
            open: false,
            list:[
                {id:1,val:2002},
                {id:1,val:2009},
                {id:1,val:2013},
                {id:1,val:2021},
            ]
        }
    },
    methods:{
        select_data(tar){
            console.log(tar)
            this.close()
        },
        close(){
            this.open = false;
        }
    }
}
</script>

<style scoped>
.wrap{
    position: absolute;
}
.list-HOAT-version{
    position: relative;
    top: 9px;
    right: 78px;
    padding: 10px 0px;
    background-color: #fff;
    background-color: #ffffff;
    border: solid 1px #D9D9D9;
    border-radius: 10px;
}
ul{
    width: 80px;
    display: flex;
    flex-direction: column;
    align-items: center; 
}
li{
    cursor: pointer;
    width: 100%;
    text-align: center;
    font-family: 'Raleway-Light';
    color: #464646;

}
li:hover{
    background-color: var(--color-akcent);
    color: #fff;
}
</style>