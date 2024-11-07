import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'

export let Project = {}

export async function LoadProjectData(id){
    let result
    result = (await apiData({typeData:'loadWholeProject', id})).data
    Project =  await result
    return result
}

export async function updateProjectObject(id, data, sendAPI=true){
    let obj = Project.objects.find(item=>item.id==id)
    for (let key in data){
        obj[key] = data[key]
    }
    if(sendAPI) await apiData({typeData:'updateProjectObject', data: obj})
    EventBus.emit('UpdatedProject')
}
