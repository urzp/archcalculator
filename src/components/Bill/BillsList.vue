<template>
    <div class="bill_list_wrap">
        <div class="name_project">{{ name_project }}</div>
        <div class="list_bills">
            <div class="item" v-for="item, index in list" :key=item.id>
                <div class="name" @click="selectBill(index)">{{ item.name }}</div>
                <div class="hover-panel">
                    <DeleteButton @click.stop="deleteBill(item.id)" width="35px" heigth="28px"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { Project } from '@/servis/projectData.js'
import { deleteBill } from '@/servis/projectBill.js'
export default{
    name: 'BillsList',
    props:{
        list:Array,
    },
    emits:['selectBill'],
    computed:{
        name_project(){
            let result = ''
            if(!!Project&&!!Project.project) result = Project.project.name
            return result
        }
    },
    methods:{
        selectBill(index){
            this.$emit('selectBill', index)
        },
        deleteBill(id){
            let index = this.list.findIndex(item=>item.id==id);
            EventBus.emit('Popap:comfirm',{
                title:'Bestätigen Sie den Löschvorgang',
                action: async ()=>{
                    this.list.splice(index, 1);
                    deleteBill(id)
                },
                
            })

        }
    }
}
</script>

<style scoped>
    .bill_list_wrap{
        min-height: 300px;
        margin-top: 60px;
        margin-bottom: 20px;
    }

    .name_project{
        font-family: 'Raleway-Light';
        font-size: 36px;
        text-align: left;
        width: 100%;
    }

    .list_bills {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .item{
        display: flex;
        font-family: 'Raleway-Light';
        font-size: 20px;
        color: #545454;
    }

    .name{
        cursor: pointer;
        margin-left: -50px;
        padding-left: 50px;
    }

    .hover-panel{
        position: absolute;
        transform: translateX(-60px);
        display: flex;
        column-gap: 5px;
        visibility: hidden;
    }

    .item:hover .hover-panel{
        visibility: visible;
    }

    .name:hover .hover-panel{
        visibility: visible;
    }
</style>