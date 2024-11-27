<template>
    <div v-if="!loading" class="show_project">
        <div class="top_panel">
            <Button width="80px" height="40px">Open</Button>
            <Button width="80px" height="40px">Delete</Button>
        </div>
        <div class="project_part">
            <div class="date">23.08.2024</div>
            <div class="title_finance">
                <div class="title">Project X</div>
                <div class="finance">€ 176.441</div>
            </div>
        </div>
        <div class="part_title">Objects</div>
        <div class="list_objects">
            <div class="item" v-for="item in list_objects" :key="item.id">
                <div class="name">{{ item.name }}</div>
                <div class="finance">{{ formatPrice(item.total) }}</div>
            </div>
        </div>
        <div class="part_title">Bils</div>
        <div class="list_objects">
            <div class="item" v-for="item in list_bils" :key="item.id">
                <div class="name_data">
                    <div class="name">{{ item.name }}</div>
                    <div class="data">{{ item.created }}</div>
                </div>
                <div class="finance">{{ formatPrice(item.total) }}</div>
            </div>
        </div>
        <div class="export_panel">
            <div class="icon"><img src="@/assets/icons/exports/xls.png" alt=""></div>
            <div class="icon"><img src="@/assets/icons/exports/pdf.png" alt=""></div>
            <div class="icon"><img src="@/assets/icons/exports/link.svg" alt=""></div>
        </div>
    </div>
    <div v-else class="loading">Loading . . .</div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name:'ShowProject',
    data(){
        return{
            timer:'',
            loading: false,
            list_objects:[
                {id:1, name:'Object A', total: 155.03},
                {id:2, name:'Object B', total: 55.03},

            ],
            list_bils:[
                {id:1, name:'Bill 1', total: 155.03, created:'10.11.2024'},
                {id:1, name:'Bill 2', total: 155.03, created:'10.11.2024'},
            ]
        }
    },
    watch:{
         id_project(){
            this.loading = true;
            clearTimeout(this.timer)
            this.timer = setTimeout(()=>{
                this.getData()
            },500)
        }
    },
    props:{
        id_project:String,
    },
    methods:{
        async getData(){
            if(!this.id_project) return false
            let result = (await apiData({typeData:'getProjectShowData', data:{id:this.id_project}})).data
            this.loading = false;
        },
        formatPrice(price){
            return `€ ${Math.fround(price).toLocaleString("de-DE")}`
        },
    }

}

</script>

<style scoped>
.show_project{
    margin-left: 40px;
    display: flex;
    flex-direction: column;
}
.top_panel{
    display: flex;
    column-gap: 10px;
    font-family: 'Raleway-Light';
    font-size: 18px;
    color: #7E7E7E;
}

.project_part{
    height: 150px;
    display: flex;
    flex-direction: column;
}

.date{
    text-align: right;
    font-size: 16px;
    color: #9F9F9F;
}
.title{
    margin-top: 30px;
    font-family: 'Raleway-Light';
    text-align: center;
    font-size: 36px;
    color:#464646;
}
.finance{
    font-family: 'Raleway-Light';
    font-size: 20px;
    text-align: center;
    color:#9A9A9A;
}

.part_title{
    font-size: 16px;
    color:#9F9F9F;
    padding-bottom: 5px;
    border-bottom: 1px solid #e2e2e2;
    margin-bottom: 20px;
}

/* objects */

.list_objects{
    height: 150px;
    overflow-y: auto;
    scrollbar-color: #7E7E7E #EDEDED;
    scrollbar-width: thin;
}

.item{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.item .name{
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    font-family: 'Raleway-Light';
    font-size: 18px;
    color: #464646;
}

.item .data{
    font-size: 12px;
    color: #9F9F9F;   
}

.item .finance{
    font-size: 18px;
}

/* Panel */

.export_panel{
    align-self: flex-end;
    width: 160px;
    border-top: 1px solid #e2e2e2;
    display: flex;
    column-gap: 10px;
    justify-content: flex-end;
}

.export_panel .icon{
    margin-top: 20px;
    widows: 40px;
    height: 40px;
    cursor: pointer;
}

.loading{
        display: flex;
        height: 100%;
        margin-left: 40px;
        width: 50%;
        justify-content: center;
        text-align: center;
        align-items: center;
        font-size: 26px;
        font-family: 'Raleway-ExtraLight';
    }

</style>