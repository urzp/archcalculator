<template>
    <div  class="wrap_sitebar" :class="{'open':config.open}">
        <ButtonSiteBar :open="config.open" @click=" config.open=!config.open "/>
    </div>
</template>

<script>
export default{
    name: 'AdminSiteBar',
    mounted(){
        this.initConfig()
    },
    data(){
        return{
            config:{
                open: true,
                calcs: true,
                offers: true,
                projects: true,
            },            
        }
    },
    watch:{
        config:{
            handler(){
                localStorage.setItem('AdminSideBarConf', JSON.stringify(this.config))
            },
            deep: true,
        }
    },
    methods:{
        initConfig(){
            let data = JSON.parse(localStorage.getItem('AdminSideBarConf'))
            if(!!data) this.config = data
            if(!data) localStorage.setItem('AdminSideBarConf', JSON.stringify(this.config))
        },
    }
}
</script>

<style scoped>
.wrap_sitebar{
    width: 350px;
    height: 100vh;
    padding-top: 65px;
    padding-left: 25px;
    position: fixed;
    left: -355px;
    z-index: 100;
    background-color: #D9D9D9;
    box-shadow: 8px 0 8px rgba(0, 0, 0, 0.25);
    transition: transform 0.5s;
    color: #464646;
}

.slide_bar{
    overflow-y: auto;
    height: 100%;
}

.title{
    display: flex;
    column-gap: 5px;
    align-self: center;
    font-family: 'Raleway-Bold';
    font-size: 20px;
    cursor: pointer;
}

.open{
    transition: transform 0.5s;
    transform: translate(355px);
}

.item_level_0{
    margin-bottom: 15px;
}


</style>