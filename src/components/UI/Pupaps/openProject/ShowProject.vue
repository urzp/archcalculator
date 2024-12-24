<template>
    <div v-if="!loading" class="show_project" @click="showSelectData=false">
    <template v-if="!!id_project">
        <div class="top_panel">
            <Button width="80px" height="40px" @click="openProject()">Open</Button>
            <Button width="80px" height="40px" @click="deleteProject()">Delete</Button>
        </div>
        <div v-if="showSelectData" class="selectData" @click.stop="">
            <div class="wrap_calendar">
            <Calendar :openMonth="new Date(project.created)" :selectDay="new Date(project.created)" :projects="[]" @selectDay="day=>setNewDate(day)"/>
            </div>
        </div>
        <div class="project_part" >
            <div class="date" @click.stop="showSelectData=true">
                {{ formatDate(project.created) }}
            </div>
            <div class="title_finance">
                <!-- <div class="title">{{ project.name }}</div> -->
                <input type="text"  class="title" :value="project.name" @change="event=>newProjectName(event.target.value)"/>
                <div class="finance">{{ formatPrice(project.total) }}</div>
            </div>
        </div>
        <div class="part_title">Objects</div>
        <div class="list_objects">
            <div class="item" v-for="item in list_objects" :key="item.id">
                <!-- <div class="name">{{ item.name }}</div> -->
                <input type="text"  class="name" :value="item.name" @change="event=>newObjecName(event.target.value, item.id)"/>
                <div class="finance">{{ formatPrice(item.total_object) }}</div>
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
    </template>
    <div v-else class="loading select_project">Select Project</div>
    </div>
    <div v-else class="loading">Loading . . .</div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { apiData } from '@/servis/apiData.js'
export default{
    name:'ShowProject',
    mounted(){
        this.getData()
    },
    data(){
        return{
            timer:'',
            loading: false,
            project:{},
            list_objects:[],
            list_bils:[],
            showSelectData:false,
        }
    },
    watch:{
         id_project(){
            //for not all load
            this.loading = true;
            clearTimeout(this.timer)
            this.timer = setTimeout(()=>{ this.getData() },500)
        }
    },
    emits:['openProject','deleteProject','softReload'],
    props:{
        id_project:{
            type:String,
            default:'',
        }
    },
    methods:{
        async getData(){
            if(!this.id_project) return false
            let result = (await apiData({typeData:'getProjectShowData', id:this.id_project})).data
            this.project = result.project
            this.list_objects = result.objects
            this.list_bils = result.bills
            this.loading = false;
        },
        async newProjectName(name){
           await apiData({typeData:'newNameProject', data:{id:this.id_project, name}})
            EventBus.emit('MenuProjects:reload')
        },
        async newObjecName(name, id){
           await apiData({typeData:'newNameObject', data:{id, name}})
            this.$emit('softReload')
        },
        async setNewDate(date){
            this.showSelectData = false
            console.log(date)
            date = date.toLocaleString('de-De', {year:'numeric', month: 'numeric',day:'numeric'})
            console.log(date)
            await apiData({typeData:'setNewDateProject', data:{id:this.id_project, date}})
            EventBus.emit('MenuProjects:reload')          
        },
        formatPrice(price){
            return `€ ${Math.fround(price).toLocaleString("de-DE")}`
        },
        formatDate(date){
            date = new Date(date)
           return date.toLocaleString("de-DE", {day:'numeric',month:'numeric', year:'numeric'})
        },
        openProject(){
            this.$emit('openProject', this.id_project)
        },
        deleteProject(){
            this.$emit('deleteProject', this.id_project)
        }
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
    cursor: pointer;
}
.selectData{
    position: relative;
    width: 0;
    height: 0;
}

.wrap_calendar{
    position: absolute;
    display: flex;
    justify-content: center;
    left: 144px;
    top: 30px;
    width: 350px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px #898989d6;
    background-color: #fff;
}

.title_finance{
    display: flex;
    flex-direction: column;
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

.selectData{
    background-color: #fff;
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
    margin-right: 10px;
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

.select_project{
    width: 100%;
    margin-left: 0;
}

</style>