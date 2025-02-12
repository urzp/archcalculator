import { reactive } from 'vue';
import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'
import { user, global } from '@/servis/globalValues.js'
import {toLetters, dateToStringNoTime} from '@/servis/functions.js'
import { newWholeProject, newObjectProject } from '@/servis/newDataProjects.js'
import {text} from '@/servis/text'

export let Project = reactive({})

export async function LoadProjectData(id, download_token, statusBill=false){
    EventBus.emit('Project:Loading')
    let result
    if(id=='local'){ 
        result = loadLocal() 
    }else{
        if(!!download_token){ 
            result =  await apiData({typeData:'loadWholeProject_by_link', data:{id, download_token}}) //open project by link
            result.data.show_by_link = true
        }else{
            if(!statusBill) result =  await apiData({typeData:'loadWholeProject', id}) //open project
            if(statusBill) result =  await apiData({typeData:'loadBill_v2', id})
        }
        if(!result.success){EventBus.emit('Project:ErrLoadeded')}
        result = result.data
    }
    await Object.assign(Project, result) 
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

export async function newPoject(save=false, status='calc'){
    delete Project['objects'];
    delete Project['project'];
    let newProject = JSON.parse( JSON.stringify(newWholeProject) )
    newProject.project.status=status
    console.log(newProject)
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
    if(Project.project.id=='local'){ 
        saveLocalProject() 
    }else{ 
        if(Project.project.status!='bill') await apiData({typeData:'updateProject', data: Project.project}) 
        if(Project.project.status=='bill') await apiData({typeData:'updateProjectBill', data: Project}) 
    }
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
        if(sendAPI){
           if(Project.project.status!='bill') await apiData({typeData:'updateProjectObject', data: obj})
            if(Project.project.status=='bill')  updateProject()
        } 
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

export async function newStatus(status){
    Project.project.status = status
    updateProject()
}

export async function projectToBill(id=Project.project.id, number_bill = billNextNuber()){
    await LoadProjectData(id)

    Project.project.locked = '0'
    Project.project.number = number_bill
    Project.project.status = 'bill'
    Project.project.id_project_contract = Project.project.id
    let user_name = !user.name?'Name':user.name
    let user_address = !user.address?'Adresse':user.address
    let user_data = `${user_name} - ${user_address}`
    Project.project.user_data = user_data
    Project.project.user_IBAN = user.IBAN
    Project.project.user_BIC = user.BIC
    Project.project.user_Institut = user.Institut
    Project.project.user_USt = user.USt
    Project.project.user_logo = `${global.base_url}/users/user_${user.id}/avatar/${user.avatar}`
    Project.project.invoice_number = 'RE - - - - -'

    Project.project.number_bill = `${number_bill}. Abschlagsrechnung`
    Project.project.greeting_phrase = text.bill.greeting_phrase,
    Project.project.payment_date = setPayment_date(number_bill)
    Project.project.created = new Date()

    let result =  await apiData({typeData:'newBill_v2', data:Project})
    let new_id = result.data
    Project.project.id = new_id
    await updateProject()
    LoadProjectData(id)
}

export async function deleteBill(id){
    apiData({typeData:'deleteBill_v2', data:id})
    LoadProjectData(Project.project.id)
}

function setPayment_date(number){
    let payment_date = {}
    if(number==Number(1)){
        payment_date.vom = new Date( )
        payment_date.bis = new Date( ).addDays(5)
    }else{
        let lastDate =  Project.bills[number-1-1].payment_date_bis
        payment_date.vom = new Date( lastDate )
        payment_date.bis = new Date( lastDate ).addDays(5)
    }
    return payment_date
}

function billNextNuber(){
   let numbers = Project.bills.map(item=>Number(item.number)) 
   let result = 1
   if(numbers.length==0) return result
   result = Math.max(...numbers) + 1
   return result
}


export async function newBillSequence(seqiuence){
    await apiData({typeData:'newBillSequence', data: seqiuence})
    LoadProjectData(Project.project.id)
}

export async function setPaidBill(value, type, id){
    await apiData({typeData:'setPaidBill', data: {id, type, value}})
    LoadProjectData(Project.project.id)
}