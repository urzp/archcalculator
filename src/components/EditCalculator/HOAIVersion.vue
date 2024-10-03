<template>

        <div class="title-project">
            <div class="name">Edit HOAI version</div>
            <div class="select-law-year">
                <div class="new_version_panel">
                    <NewButton @click="set_new_HOAI=true"/>
                    <div v-show="set_new_HOAI" class="wrap_input">
                        <InputYear :focus="set_new_HOAI" @submit_event="value=>new_HOAI(value)"/>
                        <NewButton/>
                        <CloseButton @click="resetNewSet()"/>
                    </div>
                </div>
                <div class="wrap-center">
                    <div v-show="set_editHOAI" class="wrap_input">
                        <InputYear :focus="set_editHOAI" :value="data.value" @submit_event="value=>update_HOAI(value)"/>
                        <UpdateBtn/>
                        <CloseButton @click="resetUpdate()"/>
                    </div>
                    <div class="active-version" @click="set_editHOAI=true">{{ data.value }}</div>
                    <div class="label">Select</div>
                    <Select_List  right :data='data' @selected='val=>Select(val)'/>
                </div>
                <div class="delete_panel">
                    <DeleteButton @click="deleteHOAI()" />
                </div>
            </div>
        </div>

</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'HOAIVersion',
    mounted(){
        this.getData()
    },
    data(){
        return{
            data:{
                id:'',
                value:'',
                list:[],
            },
            set_new_HOAI:false,
            set_editHOAI:false,
        }
    },
    emits:['selected'],
    methods:{
        async getData(){
            let result = await apiData({typeData:'getHOAI'})
            this.data.list = result.data
        },
        Select(data){
            this.data.value = data.value
            this.data.id = data.id_item
            this.resetNewSet()
            this.$emit('selected', {id_item:data.id_item, value:data.value})
        },
        resetNewSet(){
            this.set_new_HOAI = false
        },
        resetUpdate(){
            this.set_editHOAI = false
        },
        async new_HOAI(value){
            this.resetNewSet()
            await apiData({typeData:'newHOAI', data: value })
            await  this.getData()
            let last_item = this.data.list[this.data.list.length - 1]
            this.data.value = last_item.value
            this.data.id = last_item.id_item
        },
        async update_HOAI(value){
            await apiData({typeData:'updateHOAI', id: this.data.id, value:value })
            this.resetUpdate()
            await  this.getData()
            this.data.value = value
        },
        async deleteHOAI(){
            await apiData({typeData:'deleteHOAI', data: this.data.id })
            this.getData()
            this.data.value = ''
            this.data.id = ''
        }
    }


}
</script>

<style scoped>


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
        position: absolute;
        width: 290px;
        display: flex;
        column-gap: 15px;
    }

</style>