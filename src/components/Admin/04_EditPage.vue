<template>
    <div class="wrap_admin_editpage">
        <div class="main-title">
            <div class="title">Edit Page: {{ namePage }}</div>
        </div>
        <div class="content">
            <QuillEditor theme="snow" ref="qEditor" toolbar="essential" @ready="init()" />
        </div>
        <Button width="150px" @click="save()">Save</Button>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'EditPage',
    methods:{
        async init(){
            let data = await apiData({typeData:'adminPagesInfRead', name:this.namePage})
            if(data.success){
                this.$refs.qEditor.setHTML(data.data['content'])
            }else{
                this.$refs.qEditor.setHTML('')
            }
        },
        async save(){
            let content = this.$refs.qEditor.getHTML()
            console.log(content)
            await apiData({typeData:'adminPagesInfUpdate', name:this.namePage, content})
        },
    },
    props:{
        namePage:String,
    },
    watch:{
        namePage(){
            this.init()
        }
    }
}
</script>

<style scoped>
    .wrap_admin_editpage{
        min-height: 75vh;
        margin-bottom: 50px;
    }

    .title{
        margin-top: 60px;
        text-align: center;
        font-size: 36px;
        font-family: 'Raleway-Light';
        color: #2c3e50;
    }

    .content{
        margin-bottom: 20px;
    }

</style>