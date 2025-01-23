import { reactive } from 'vue';
import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'
import { global } from '@/servis/globalValues.js'
import {toLetters} from '@/servis/functions.js'
import { newWholeProject, newObjectProject } from '@/servis/newDataProjects.js'

export let Project = reactive({})

export async function LoadProjectData(id, download_token){
    EventBus.emit('Project:Loading')
    let result
    if(id=='local'){ 
        result = loadLocal() 
    }else{
        if(!!download_token){ 
            result =  await apiData({typeData:'loadWholeProject_by_link', data:{id, download_token}}) //open project by link
            result.data.show_by_link = true
        }else{
            result =  await apiData({typeData:'loadWholeProject', id}) //open project
        }
        if(!result.success){EventBus.emit('Project:ErrLoadeded')}
        result = result.data
    }
    Object.assign(Project, result) 
    window.project = Project
    EventBus.emit('Project:Loaded')
    return Project
}

export async function saveNewProject(){
    if(!!Project.show_by_link) return false 
    Project.project.unsaved = false
   let result = (await apiData({typeData:'newProject', data: Project})).data
   let id_project = result.project
   Project.project.id = id_project
   localStorage.setItem('OpendProject', id_project)
   localStorage.removeItem('Project')
   //saveLocalProject()
   EventBus.emit('Project:newProjectUser', id_project)
    //EventBus.emit('Menu:Message', 'Saved')
}

export async function saveUnUserNewProject(){
    if(!!Project.show_by_link) return false
    let result = (await apiData({typeData:'newUnUserProject', data: Project})).data
    Project.project.id_save = result.project
    Project.project.downLoad_token = result.downLoad_token
    Project.project.owner_token = result.owner_token
    return { id:result.project, downLoad_token:result.downLoad_token }
}

function loadLocal(){
    let  result = localStorage.getItem('Project')
    if(!result){result = newPoject()}else{result = JSON.parse(result)} 
    return result
}

export async function newPoject(save=false){
    delete Project['objects'];
    delete Project['project'];
    let newProject = JSON.parse( JSON.stringify(newWholeProject) )
    Object.assign(Project, newProject)
    EventBus.emit('Project:Loadeded')
    if(save) saveNewProject()
    return Project 
}

export async function updateProject(){
    if(!!Project.show_by_link) return false
    if (Project.project.id=='new'){
        if(global.login) await saveNewProject()
        if(!global.login) setUnSavedStatus()
    }
    if(Project.project.id=='local'){ saveLocalProject() }else{ await apiData({typeData:'updateProject', data: Project.project}) }
}

export async function saveLocalProject(){
    let projectJSON = JSON.stringify(Project)
    localStorage.setItem('Project', projectJSON);
    if(!!Project.project.owner_token) await apiData({typeData:'updateUnUserProject', data: Project.project})
    switchToLocal()
}

export function setUnSavedStatus(){
    Project.project.unsaved = 'true'
    if(Project.project.id=='new') Project.project.id = 'local'
}

export async function updateProjectObject(id, data=[], sendAPI=true){
    if(!!Project.show_by_link) return false
    let obj = Project.objects.find(item=>item.id==id) // need to create id for local
    for (let key in data){ obj[key] = data[key] }
    if(Project.project.id=='local'||Project.project.id=='new'){ 
        if(!!Project.project.owner_token){
            let project_id = Project.project.id_save
            await apiData({typeData:'updateUnUserProjectObject', data: {obj, project_id} })
        } 
        await saveLocalProject() 
        switchToLocal()
    }else{
        if(sendAPI) await apiData({typeData:'updateProjectObject', data: obj})
    }
    
    EventBus.emit('UpdatedProject')

}

function switchToLocal(){
    if(Project.project.id=='new'){ EventBus.emit('Project:saveAsLocal'); }
}

export async function newProjectObject(project_id, number=0){
    let newObject = {...newObjectProject}
    newObject.number = number
    newObject.name = newObject.name.replace("A", toLetters(number + 1).toUpperCase()) 
    newObject.project_id = project_id
    await Project.objects.push(newObject)
    if(Project.project.id=='local'||Project.project.id=='new'){ await  newProjectObjectLoacal() }else{ await apiData({typeData:'newProjectObject', data: newObject}) }
    EventBus.emit('Project:newObject')
}

async function newProjectObjectLoacal(){
    await Project.objects.forEach((item,index)=>item.id=index)
    await saveLocalProject()
}

export async function deleteProjectObject(id){
    if(Project.project.id=='local'||Project.project.id=='new'){ deleteLocalProjectObject(id) }else{  
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
