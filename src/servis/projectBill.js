import { reactive } from 'vue';
import { Project } from '@/servis/projectData.js'
import { user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'

export let Bills = reactive([]);

window.bills = Bills

export async function clearBills(){
    Bills.splice(0, Bills.length)
} 

export async function LoadBills(project_id){
    clearBills()
    if(project_id=='local') return false
    let result = await apiData({typeData:'LoadBills', project_id})
    if(!(!!result.data&&result.data.length>0)) return false
    await result.data.forEach(element => {
        Bills.push(element.data)
    });
    return true
}

export async function saveBill(id){
    let element = Bills.find(item=>item.id==id)
    apiData({typeData:'updateBill', data:element})
}

export async function deleteBill(id){
    apiData({typeData:'deleteBill', data:id})
}


export async function newBill(project_id, number){

    let custemer = {...Project.project.customer}

    let user_name = !user.name?'Name':user.name
    let user_address = !user.address?' - Adresse':user.address

    let newBill = {
        number,
        name:'Neue Rechnung',
        project_id,
        name_user: `${user_name} ${user_address}`,
        custemer,
        project:{
            name: Project.project.name,
            discription: Project.project.discription,
        },
        total:0,
    } 
    let result = await apiData({typeData:'newBill', data:newBill})
    newBill.id = result.data
    return newBill
}