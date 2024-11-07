import { apiData } from '@/servis/apiData.js'

export let CalcData = {}

export async function LoadCalcData(){
    let result
    result = (await apiData({typeData:'loadWholeCalcData'})).data
    CalcData =  await result
    return result
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
    return {rate_values}
}

