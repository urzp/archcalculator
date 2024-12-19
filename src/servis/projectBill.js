import { reactive } from 'vue';
import { CalcData } from '@/servis/calcData.js'
import { Project } from '@/servis/projectData.js'
import { user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
import {  lastElement } from '@/servis/functions.js'

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

    let payment_date = setPayment_date()
    let number_bill = `${Bills.length + 1}. Abschlagsrechnung`
    let objects = setObjects()

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
        payment_date,
        invoice_number: 'RE - - - - -',
        created: new Date(),
        number_bill, 
        greeting_phrase: window.text.bill.greeting_phrase,
        objects,
        total:0,
    } 
    let result = await apiData({typeData:'newBill', data:newBill})
    newBill.id = result.data
    return newBill
}


function setPayment_date(){
    let payment_date = {}
    if(Bills.length==0){
        payment_date.vom = new Date( Project.project.created )
        payment_date.bis = new Date( Project.project.created ).addDays(5)
    }else{
        let lastDate =  lastElement(Bills).payment_date.bis
        payment_date.vom = new Date( lastDate )
        payment_date.bis = new Date( lastDate ).addDays(5)
    }
    return payment_date
}

function setObjects(){
    let result = []
    Project.objects.forEach( item=>{
        let newItem = {}
        newItem.id = item.id
        newItem.name = item.name
        newItem.honorar_zone = item.honorarLevel.number
        newItem.honorar_satz = item.HonorarRate.value
        newItem.costs = getCosts(item.finance)
        newItem.total = item.total_object
        newItem.stages = getStages(item)
        result.push(newItem)
    })
    return result
}

function getCosts(finance){
    if(!finance.useDetals) return finance.value
    let result = 0
    finance.detals.forEach(item=>{
        result = result + Number(item)
    })
    return result
}

export function getCosts_ById(id){
    let project_obj = Project.objects.find(item=>item.id==id)
    if(!project_obj||!project_obj.finance) return 0
    return getCosts(project_obj.finance)
}

function getStages(project_object){
    let result = []
    let paragraph_id = project_object.paragraph_id
    result = CalcData.Stages.filter(item=>item.id_paragraph==paragraph_id)
    result.forEach( (item, index)=>{
        item.user_percent = Number(project_object.stages[index])
        item.done = 0
        item.factor = 0
    })
    return result
}

export function getStages_ById(id){
    let project_obj = Project.objects.find(item=>item.id==id)
    if(!project_obj||!project_obj.finance) return []
    return getStages(project_obj)
}