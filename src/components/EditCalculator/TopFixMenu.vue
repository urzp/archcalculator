<template>
    <div v-show="show" class="wrap-fix-menu">
        <div class="main-title">
            <div class="title">Edit HOAI version</div>
            <div class="HOAI-version">{{ data_HOAI.value }}</div>
        </div>
        <div class="sub-title">
            <div class="paragraph-val">{{ paragraph.name }} </div>
            <div class="paragraph-val">{{ paragraph.title }} </div>
        </div>
    </div>
</template>


<script>
export default {
    name:'TopFixMenu',
    mounted() {
        window.addEventListener("scroll", this.onScroll)
    },
    data(){
        return{
            show:false
        }
    },
    props:{
        data_HOAI:Object,
        paragraph:Object,
    },
    methods:{
        onScroll(e) {
            let windowTop = window.top.scrollY /* or: e.target.documentElement.scrollTop */
            if(windowTop > 400){
                this.show = true
            }else{
                this.show = false
            }
        }
    }
}
</script>

<style scoped>
    .wrap-fix-menu{
        margin: 0;
        padding: 30px 0px;
        position: fixed;
        top: 0; 
        width: 1156px;
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        
    }

    .main-title, .sub-title{
        display: flex;
        column-gap: 15px;
        align-items: baseline;
    }

    .main-title{
        font-size: 30px;
    }
    .sub-title{
        font-size: 20px;
    }
    .title, .sub-title{
        font-family: 'Raleway-Light';
        color: #2c3e50;
    }
</style>