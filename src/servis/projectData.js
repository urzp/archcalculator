import { reactive } from 'vue';
import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'
import { newWholeProject, newObjectProject } from '@/servis/newDataProjects.js'

export let Project = {}

export async function LoadProjectData(id){
    let result
    if(id=='local'){ result = loadLocal() }else{ result = (await apiData({typeData:'loadWholeProject', id})).data }
    Project =  await result
    EventBus.emit('Project:Loadeded')
    return result
}

function loadLocal(){
    let  result = localStorage.getItem('Project')
    if(!result){result = newPoject()}else{result = JSON.parse(result)} 
    return result
}

export async function newPoject(){
    Project =  newWholeProject
    EventBus.emit('Project:Loadeded')
    return Project 
}

export async function updateProject(){
    if(Project.project.id=='local'){ saveLocalProject() }else{ await apiData({typeData:'updateProject', data: Project.project}) }
}

export async function saveLocalProject(){
    let projectJSON = JSON.stringify(Project)
    localStorage.setItem('Project', projectJSON);
}

export async function updateProjectObject(id, data, sendAPI=true){
    let obj = Project.objects.find(item=>item.id==id)
    for (let key in data){
        obj[key] = data[key]
    }
    if(Project.project.id=='local'){ await saveLocalProject() }else{
        if(sendAPI) await apiData({typeData:'updateProjectObject', data: obj})}
    EventBus.emit('UpdatedProject')
}

export async function newProjectObject(project_id){
    let newObject = newObjectProject
    newObject.project_id = project_id
    if(Project.project.id=='local'){ await  newProjectObjectLoacal(newObject) }else{ await apiData({typeData:'newProjectObject', data: newObject}) }
    EventBus.emit('Project:newObject')
}

async function newProjectObjectLoacal(newObject){
    await Project.objects.push(newObject) 
    await Project.objects.forEach((item,index)=>item.id=index)
    await saveLocalProject()
}

export async function deleteProjectObject(id){
    if(Project.project.id=='local'){ deleteLocalProjectObject(id) }else{  
        await apiData({typeData:'deleteProjectObject', data: id})
    }
    EventBus.emit('Project:deleteObject') 
}

async function deleteLocalProjectObject(id){
    let objects = Project.objects
    let index = objects.findIndex(item=>item.id==id)
    objects.splice(index, 1);
    await saveLocalProject()
}
