import { apiData } from '@/servis/apiData.js'
import { lastElement } from '@/servis/functions.js'

export let CalcData = {}

export async function LoadCalcData(){
    let result
    result = getLocalHost()
    if(!result||await checkNewVersion()){
        result = (await apiData({typeData:'loadWholeCalcData'})).data
        saveLocalHost(result)
    }
    CalcData =  await result
    return result
}

async function checkNewVersion(){
    let local_HOAI_updated = localStorage.getItem('HOAI_updated')
    let HOAI_updated = (await apiData({typeData:'calc:getHOAI_updated'})).data.value
    localStorage.setItem('HOAI_updated', HOAI_updated)
    if(local_HOAI_updated!=HOAI_updated) return true
    let result = false
    
    return result  
}

function saveLocalHost(CalcData){
    let CalcDataJSON = JSON.stringify(CalcData)
    localStorage.setItem('CalcData', CalcDataJSON);
}

function getLocalHost(){
    let CalcDataJSON = localStorage.getItem('CalcData')
    let CalcData = JSON.parse(CalcDataJSON)
    return CalcData
}

export function getAllowableCosts(id_paragraph){
    if(!CalcData.allowableCosts)return false
    return CalcData.allowableCosts.filter(item=>item.id_paragraph == id_paragraph)
}

export function getTypeValue(id_paragraph){
    if(!CalcData.feeTableTypeValue)return false
    let result =  CalcData.feeTableTypeValue.find(item=>item.id_paragraph == id_paragraph)
    if(!result||!result.value||result.value=='Eur'){return '€'}else{return result.value}
}

export function getParagraphs(id_HOAI){
    if(!CalcData.feeTableTypeValue)return false
    return CalcData.paragraphs.filter(item=>item.id_HOAI == id_HOAI)
}

export function getParagraph(id){
    if(!CalcData.feeTableTypeValue)return false
    return CalcData.paragraphs.find(item=>item.id == id)
}

export function getSameParagraph(id_HOAI, id_paragpaph){
    let paragraphs = getParagraphs(id_HOAI)
    if(!paragraphs||!paragraphs.length) return false
    if(!id_paragpaph){  return paragraphs[0].id }
    let paragraph = getParagraph(id_paragpaph)
    let result = paragraphs.find(item=>item.paragraph == paragraph.paragraph).id
    return result
}

export function getHonorarZones(id_paragraph){
    if(!CalcData.feeTableHonorarZones){ console.log('!CalcData.feeTableHonorarZones'); return  false}
    let result = CalcData.feeTableHonorarZones.filter(item=>Number(item.id_paragraph)==Number(id_paragraph))
    result.forEach(item=>item.value = item.name)
    return result
}

export function getFeeTable(id_paragraph){
    if(!CalcData.feeTableRateValue) return false
    let rate_values = CalcData.feeTableRateValue.filter(item=>item.id_paragraph==id_paragraph)
    let honorarZones = CalcData.feeTableHonorarZones.filter(item=>item.id_paragraph==id_paragraph)
    rate_values.forEach(rate => {
        let zones = []
        honorarZones.forEach(zone_item=>{
           let zone = CalcData.feeTableHonorarZonesRateValue.find(item=>rate.id==item.id_feeTableRateValue&&zone_item.id==item.id_feeTableHonorarZones)
           zones.push(zone)
        })
        rate.zones = zones
    });
    return rate_values
}

export function financeLimits(id_paragraph){
    if(!CalcData.feeTableRateValue) return false
    let rate_values = CalcData.feeTableRateValue.filter(item=>item.id_paragraph==id_paragraph)
    let min = rate_values[0].value
    let max = lastElement(rate_values).value
    return {min, max}
}

export function getRequirementsPoints(id_paragraph){
    if(!CalcData.requirementsPoints) return []
    let result = CalcData.requirementsPoints.filter(item=>item.id_paragraph==id_paragraph)
    result.forEach(item=>item.value = item.minPoint)
    return result
}

export async function getStages(id_paragraph){
    if(!CalcData.requirementsPoints||!id_paragraph) return []
    let result = CalcData.Stages.filter(item=>item.id_paragraph==id_paragraph)
    result.forEach(item=>{
        let subStages = CalcData.subStage.filter(sub_item=>sub_item.id_stage==item.id)
        subStages.forEach(sub_item=>{
            let subStage_l1 = CalcData.subStage_l1.filter(subL1_item=>subL1_item.id_subStage == sub_item.id)
            sub_item.subStage_l1 = subStage_l1
        })
        item.subStages = subStages
    })
   
    return result
}