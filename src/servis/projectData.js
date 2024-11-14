import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'

export let Project = {}

export async function LoadProjectData(id){
    let result
    result = (await apiData({typeData:'loadWholeProject', id})).data
    Project =  await result
    return result
}

export async function updateProject(){
    await apiData({typeData:'updateProject', data: Project.project})    
}

export async function updateProjectObject(id, data, sendAPI=true){
    let obj = Project.objects.find(item=>item.id==id)
    for (let key in data){
        obj[key] = data[key]
    }
    if(sendAPI) await apiData({typeData:'updateProjectObject', data: obj})
    EventBus.emit('UpdatedProject')
}

export async function newProjectObject(project_id){
    let newObject = {
        user_id:1,
        project_id,
        name: 'New Object',
        HOAI_version_id:2,
        paragraph_id:8,
        honorarLevel: {id:30,number:1,value:"Honorarzone I",usePoints:false},
        honorarLevelDetals:[{value: 5},{value: 7},{value: 6 },{value: 4},{value: 3},{value: 2}],
        HonorarRate:{id:3,value:"Mittelsatz",percent:50},
        finance:{value: 450000,useDetals: false, detals:[], userTitle:[]},
        payExtra:{percent:0},
    }
    await apiData({typeData:'newProjectObject', data: newObject})
    EventBus.emit('Project:newObject')
}

export async function deleteProjectObject(project_id){
    await apiData({typeData:'deleteProjectObject', data: project_id})
    EventBus.emit('Project:deleteObject') 
}
