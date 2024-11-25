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
                    <SelectEdit_List   
                    noDelete
                    :data='data' 
                    @selected='val=>Select(val)'
                    @newElement="set_new_HOAI=true"
                    @moveElement = "data=>moveElemnt(data)"/>
                </div>
                <div class="delete_panel">
                    <DeleteButton @click="deleteHOAI()" />
                </div>
            </div>
            <div v-if="!!data.id" class="public">
                <Button width="125px" @click="switchPuplish()">{{ !puplish? 'Publish':'Unpublish' }}</Button>
                <div class="label">{{ puplish? 'Published':'Unpublished' }}</div>
            </div>
        </div>

</template>

<script>
import { EventBus } from '@/servis/EventBus'
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
    computed:{
        puplish(){
            if(!this.data||!this.data.list) return false
            let element = this.data.list.find(item=>item.id==this.data.id)
            if(!element) return false
            return element.puplish=='0'?false:true
        }
    },
    emits:['selected'],
    methods:{
        async getData(){
            let result = await apiData({typeData:'getHOAI'})
            this.data.list = result.data
        },
        Select(data){
            let element = this.data.list.find(item=>item.id==data.id_item)
            this.data.id = element.id
            this.data.value = element.value
            this.resetNewSet()
            this.$emit('selected', {id_item:element.id, value:element.value})
        },
        resetNewSet(){
            this.set_new_HOAI = false
        },
        resetUpdate(){
            this.set_editHOAI = false
        },
        async new_HOAI(value){
            this.resetNewSet()
            let newElement = {
                value,
            }
            await apiData({typeData:'newHOAI', data: newElement })
            await  this.getData()
            let last_item = this.data.list[this.data.list.length - 1]
            this.data.value = last_item.value
            this.data.id = last_item.id_item
        },
        async update_HOAI(value){
            let element = {
                value,
                id: this.data.id,
            }
            await apiData({typeData:'updateHOAI', data: element })
            this.resetUpdate()
            await  this.getData()
            this.data.value = value
        },
        async moveElemnt(data){
            let element = data[0]
            let nextElement = data[1]
            await apiData({typeData:'updateHOAI', data: element })
            await apiData({typeData:'updateHOAI', data: nextElement })
            this.getData()
        },
        async deleteHOAI(){     
            let _this = this
            EventBus.emit('Popap:comfirm',async ()=>{
                await apiData({typeData:'deleteHOAI', data: _this.data.id })
                _this.getData()
                _this.data.value = ''
                _this.data.id = ''
            })
        },
        async switchPuplish(){
            await apiData({typeData:'switchPuplishHOAI', data: this.data.id})
            this.getData()
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
    }

    .label{
        margin-left: 15px;
        margin-right: 15px;
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

    ul{
        align-items: flex-start;
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

    .public{
        margin-top: 20px;
        font-family: 'Raleway-Light';
        font-size: 20px;
        display: flex;
        align-items: center;
    }

    .public .label{
        width: 137px;
        text-align: left;
    }

</style>