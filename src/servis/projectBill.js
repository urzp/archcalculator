import { reactive } from 'vue';
import { Project } from '@/servis/projectData.js'
import { user } from '@/servis/globalValues.js'

export let Bills = reactive([]);

export async function clearBills(){
    Bills.splice(0, Bills.length)
} 

export async function newBill(project_id, number){

    let custemer = {...Project.project.customer}

    let user_name = !user.name?'Name':user.name
    let user_address = !user.address?' - Adresse':user.address

    let newBill = {
        id: 'new',
        number,
        project_id,
        name_user: `${user_name} ${user_address}`,
        custemer,
    } 

    return newBill
}