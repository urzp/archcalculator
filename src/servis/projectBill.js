import { reactive } from 'vue';
import { CalcData } from '@/servis/calcData.js'
import { Project } from '@/servis/projectData.js'
import { user, global } from '@/servis/globalValues.js'
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

export async function saveAllBills(){
    Bills.forEach(async item=>{
        await apiData({typeData:'updateBill', data:item})
    })
}

export async function deleteBill(id){
    apiData({typeData:'deleteBill', data:id})
}

export function setPaid(value, name_value ,id){
    let element = Bills.find(item=>item.id==id)
    element.paid[name_value] = value
    updatePaids(id)
    saveAllBills()
}

function updatePaids(id){
    let updated_bill = Bills.find(item=>item.id==id)
    Bills.forEach(bill=>{
       let bills_previos =  bill.paid.previous.filter(item=>item.bill_id == id)    
        bills_previos.forEach(item=>{
            item.value = updated_bill.paid.value
            item.invoice_number = updated_bill.paid.invoice_number
            item.date = updated_bill.paid.date
        })
    })
}

export async function newBill(project_id, number = Bills.length){
    await setNumbers(number)
    let custemer = {...Project.project.customer}

    let user_data = `${user.name} - ${user.address} - ${user.postcode} - ${user.cityName}`
    let user_IBAN = user.IBAN
    let user_BIC = user.BIC
    let user_Institut = user.Institut
    let user_USt = user.USt
    let user_logo = `${global.base_url}/users/user_${user.id}/avatar/${user.avatar}`

    let payment_date = setPayment_date(number)
    let number_bill = `${Bills.length + 1}. Abschlagsrechnung`
    let objects = await setObjects(number)
    let extraServis = initExtraServis(Project.project.AdditionalServices)
    let totalExtraServis = countTotalExtraServis(extraServis)
    let extraCosts = initExtraCosts(Project.project.ExtraCosts)
    let totalExtraCosts = countTotalExtraServis(extraCosts)
    let total_objects = objects.reduce((summ, item) => summ + item.total, 0);
    let total_net = total_objects + totalExtraCosts + totalExtraServis
    let tax = Project.project.tax
    let total_tax = total_net * Number(Project.project.tax)/100
    let total = total_tax + total_net
    let paid = initPaid(number)
    let total_rest = 0

    let newBill = {
        number,
        name:'Neue Rechnung',
        project_id,
        user_name,
        user_address,
        user_data,
        user_IBAN,
        user_BIC,
        user_Institut,
        user_USt,
        user_logo,

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
        extraServis,
        totalExtraServis,
        extraCosts,
        totalExtraCosts,
        total_objects,
        total_net,
        tax,
        total_tax,
        total,
        paid,
        total_rest,
    } 
    let result = await apiData({typeData:'newBill', data:newBill})
    newBill.id = result.data
    return newBill
}

async function setNumbers(number){
    if(number == Bills.length) return false
    let moreNumber = Bills.filter(item=>item.number>=number)
    let orderData = []
    moreNumber.forEach(item=>{
        item.number = item.number + 1
        orderData.push( {id:item.id, number: item.number} )
    })
    await apiData({typeData:'newBillOrders', data:orderData})
    return true
}

export async function sequence(){
    if(Bills.length==0) return false
    let orderData = []
    Bills.forEach( (item, index)=>{
        item.number = index
        orderData.push( {id:item.id, number: item.number} )
    })
    await apiData({typeData:'newBillOrders', data:orderData})
    return true   
}


function setPayment_date(number){
    let payment_date = {}
    if(number==0){
        payment_date.vom = new Date( Project.project.created )
        // payment_date.bis = new Date( Project.project.created ).addDays(5)
        payment_date.bis = new Date()
    }else{
        let lastDate =  Bills[number-1].payment_date.bis
        payment_date.vom = new Date( lastDate )
        // payment_date.bis = new Date( lastDate ).addDays(5)
        payment_date.bis = new Date()
    }
    console.log(payment_date)
    return payment_date
}

function setObjects(number){
    let result = []
    Project.objects.forEach( async item=>{
        let newItem = {}
        newItem.id = item.id
        newItem.name = item.name
        newItem.honorar_zone = item.honorarLevel.number
        newItem.honorar_satz = item.HonorarRate.value
        newItem.costs = getCosts(item.finance)
        newItem.honorar_total = item.honorar_total
        newItem.stages = await getStages(item, number)
        newItem.stages_total = getStagesTotal(newItem.stages)
        newItem.stagesTotal = newItem.stages_total.price
        newItem.stagesExtra = calculateServisExstra(item.specialServices, newItem.honorar_total)
        newItem.stagesExtraTotal = calculatestagesExstraTotal(newItem.stagesExtra)
        newItem.total = newItem.stagesTotal + newItem.stagesExtraTotal
        result.push(newItem)
    })
    return result
}

export async function setDefaulObjects(id){
    let bill =  Bills.find(item=>item.id == id)
    //delete bill.objects
    bill.objects = setObjects(bill.number)
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

async function  getStages(project_object, number){
    let result = []
    let paragraph_id = project_object.paragraph_id
    result = CalcData.Stages.filter(item=>item.id_paragraph==paragraph_id)
    result = result.map(item=>({...item}))

    result.forEach( (item, index)=>{
        item.user_percent = Number(!project_object.stages[index]?0:project_object.stages[index])
        item.done = 0
        item.factor = 1
        item.total = 0
        item.subStages = {}
    })
    
    fillStages(result, project_object.id, number)
    return result
}

function fillStages(stages, id_object, index){
    
    if(index==0) return false
    let honorar = Project.objects.find(item=>item.id==id_object).honorar_total
    let priviosBill = Bills[index - 1]
    let stagesPrivios = priviosBill.objects.find(item=>item.id==id_object)

    if(!stagesPrivios||!stagesPrivios.stages) return false
    stagesPrivios = stagesPrivios.stages

    stages.forEach((item,index)=>{ 
        item.done = stagesPrivios[index].done
        item.total = (item.done/100) * Number( honorar )
    })
}

function getStagesTotal(stages){
    let result = {
        price: 0,
        done: 0,
        percent: 0,
    }
    stages.forEach(item=>{
        result.price = result.price + Number(item.total)
        result.done = result.done + Number(item.done)
        result.percent = result.percent + Number(item.percent)
    })
    return result
}

export function getStages_ById(id){
    let project_obj = Project.objects.find(item=>item.id==id)
    if(!project_obj||!project_obj.finance) return []
    return getStages(project_obj)
}

function calculateServisExstra(stagesExtra, honorar){
    let result = []
    stagesExtra.forEach(item=>{
        let newItem = {...item}
        newItem.total = honorar * Number(item.percent)/100
        result.push(newItem)
    })
    return result
}

function calculatestagesExstraTotal(stagesExtra){
    let result = 0
    stagesExtra.forEach(item=>{
        result = result + Number(item.total)
    })
    return result
}

export function initExtraServisById(id){
    let bill = Bills.find(item=>item.id==id)
    delete bill.extraServis
    bill.extraServis = initExtraServis(Project.project.AdditionalServices)
    bill.totalExtraServis = countTotalExtraServis(bill.extraServis)
}

function initExtraServis(extraServis){
    let result = []
    if(!extraServis) return result
    extraServis.forEach(item=>{
        let newItem = {...item}
        newItem.total = Number(item.hours) * Number(item.price_hours)
        result.push(newItem)
    })
    return result
}

function countTotalExtraServis(extraServis){
    let result = 0
    extraServis.forEach(item=>{
        result = result + Number(item.total)
    })
    return result
}

export function initExtraCostsById(id){
    let bill = Bills.find(item=>item.id==id)
    delete bill.extraCosts
    bill.extraCosts = initExtraCosts(Project.project.ExtraCosts)
    bill.totalExtraCosts = countTotalExtraCosts(bill.extraCosts)
}

function initExtraCosts(extraCosts){
    let result = []
    if(!extraCosts) return result
    extraCosts.forEach(item=>{
        let newItem = {...item}
        newItem.total = Number(item.rate) * Number(item.price_rate)
        result.push(newItem)
    })
    return result
}

function countTotalExtraCosts(extraCosts){
    let result = 0
    extraCosts.forEach(item=>{
        result = result + Number(item.total)
    })
    return result
}

function initPaid(number){
    let result = {
        invoice_number: 'RE - - - - -',
        value: 0,
        date:'',
        fact_paid:false,
        previous : [],
    }
    Bills.filter(item=>item.number<number).forEach( (item, index)=>{
        if(!!item.paid){
            let newitem = {...item.paid}
            newitem.bill_id = item.id
            newitem.id = index
            delete newitem.previous;
            result.previous.push(newitem)
        }
    })
    return result
}

export function initPaidPrevious(id){
   let actualBill =  Bills.find(item=>item.id==id)
   let number = actualBill.number
   actualBill.paid.previous = []
   Bills.filter(item=>item.number<number).forEach( (item, index)=>{
        let newitem = {...item.paid}
        newitem.bill_id = item.id
        newitem.id = index
        delete newitem.previous;
        console.log(newitem)
        actualBill.paid.previous.push(newitem)
    })
}