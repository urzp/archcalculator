<template>
    <div class="wrap">
        <div class="title">Bewertungsmerkmale</div>
        <div class="header">
            <div class="part left-part">
                <div class="number">#</div>
                <div class="name">Name</div>
            </div>
            <div class="part left-right">
            <div>Anforderungen:</div>
            <div class="min">geringe </div>
            <div class="max">hohe</div>
            </div>
        </div>
        <div class="list">
            <div class="item" v-for="item, index in list" :key="item.id">
                <div class="part left-part">
                    <div class="hover-panel">
                        <DeleteButton @click.stop="deleteElement(item.id)" width="35px" heigth="28px"/>
                    </div>
                    <div class="number">{{ index + 1 }}</div>
                    <InputText width="800px" :value="item.name" @submit_event="value=>update(index, value, 'name')"/>
                </div>
                <div class="part right-part">
                    <InputText width="55px" :value="item.minPoint" @submit_event="value=>update(index, value, 'minPoint')"/>
                    <InputText width="40px" :value="item.maxPoint" @submit_event="value=>update(index, value, 'maxPoint')"/>
                </div>
            </div>
        </div>
        <NewButton style="margin-top: 10px;" width="160px" heigth="28px" @click="newElement()"/>
    </div>
</template>

<script>
import { apiData } from '@/servis/apiData.js'
export default{
    name: 'RequirementsPoints',
    mounted(){
        this.getData()
    },
    data(){
        return{
            list:[]
        }
    },
    props:{
        id_paragraph:String    
    },
    watch:{
        id_paragraph(){
            this.getData()
        }
    },
    methods:{
        async getData(){
            let result = await apiData({typeData:'RequirementsPoints', id: this.id_paragraph})
            this.list = result.data
        },
        async update(index, value, val_name){
            let element = this.list[index] 
            element[val_name] = value
            await apiData({typeData:'updateRequirementsPoints', data: element})
            this.getData()
        },
        async newElement(){
            let data = {
                id_paragraph:this.id_paragraph, 
                sequence: this.list.length,
                name: '----',
                minPoint: 0,
                maxPoint: 0,
            }
            await apiData({typeData:'newRequirementsPoints', data})
            this.getData()    
        },
        async deleteElement(id){
            await apiData({typeData:'deleteRequirementsPoints', data: id})
            this.getData()    
        }
    }
}

</script>

<style scoped>
    .title{
        font-family: 'Raleway-Light' ;
        font-size: 20px;
    }


    .header{
        margin-top: 20px;
        display: flex;
        column-gap: 15px;
        font-family: 'Raleway-Light' ;
        font-size: 18px;
        justify-content: space-between;
    }

    .item{
        display: flex;
        column-gap: 20px;
        align-items: center;
        justify-content: space-between;
    }

    .number{
        font-family: 'Raleway-Light' ;
        font-size: 18px;      
    }

    .part{
        display: flex;
        column-gap: 20px;
    }
    .right-part{
        column-gap: 20px;
    }

    .max{
        width: 64px;
    }


    /* hover button */

    .part{
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

    .part:hover .hover-panel{
        visibility: visible;
    }

</style>
