<template>
    <div class="wrap">
        <div class="title-project">
            <div class="name">Edit HOAI version</div>
            <div class="select-law-year">
                <div class="new_version_panel">
                    <NewButton @click="set_new_HOAI=true"/>
                    <div v-show="set_new_HOAI" class="wrap_input">
                        <InputYear :focus="set_new_HOAI"/>
                    </div>
                </div>
                <div class="wrap-center">
                    <div class="active-version">{{ data.value }}</div>
                    <div class="label">Select</div>
                    <Select_List  right :data='data' @selected='val=>Select(val)'/>
                </div>
                <div class="delete_panel">
                    <DeleteButton />
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'EditCalculator',
    data(){
        return{
            data:{
                value:'',
                list:[
                {id:1, val:2013},
                {id:2, val:2021},
                ]
            },
            set_new_HOAI:false,
        }
    },
    methods:{
        Select(val){
            this.data.value = val
        }
    }


}
</script>

<style scoped>
    .wrap{
        min-height: 75vh;
    }

    .title-project{
        margin-top: 60px;
        text-align: center;
    }
    .title-project .name{
        font-family: 'Raleway-Light';
        font-size: 36px;
    }
    .wrap-center{
        display: flex;
        align-items: center;
        column-gap: 15px;
    }
    .select-law-year{
        font-size: 20px;
        font-family: 'Raleway-Light';
        color: #464646;
        display: flex;
        justify-content: space-between;
        align-items: center;
        column-gap: 15px;
    }
    .new_version_panel{
        display: flex;
        align-items: center;
        column-gap: 15px;
        margin-right: auto;
    }
    .delete_panel{
        margin-left: auto;
    }
    .wrap_input{
        position: relative;
        width: 0px;
    }

</style>