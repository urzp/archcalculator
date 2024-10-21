import { apiData } from '@/servis/apiData.js'
import { convertToRoman } from '@/servis/functions.js'
export async function getHOAIData(selected){
    let HOAIData = {
        HOAT_v:[],
        paragraphs:{},
        feeZone:{},
        equivalent:{},
        requirementPoints:{},
    }

    HOAIData.HOAT_v = (await apiData({typeData:'getHOAI'})).data
    HOAIData.paragraphs = await getParagraphs( selected.id_HOAI_v)
    let zone = await getFeeZones(selected.id_paragraph)
    HOAIData.feeZone = zone.feeZone
    HOAIData.equivalent = zone.equivalent
    HOAIData.requirementPoints = await getRequirementPoints(selected.id_paragraph)
    HOAIData.requirementPoints.equivalent = HOAIData.equivalent
    return HOAIData
}

async function getParagraphs(id_HOAI){
    let result = (await apiData({typeData:'Paragraphs', id_HOAI})).data
    result = result.map(item=>{return { id:item.id, value: `${item.name} ${item.title}` } })
    return result
}

async function getFeeZones(id_paragraph){
    let data = { 
        table : 'feeTableHonorarZones',
        selector_name : 'id_paragraph',
        selector : id_paragraph,
    }
    let result = (await apiData({typeData:'read', data})).data
    result = result.filter(item=>item.number!='0')
    let feeZone = result.map((item,index)=>{
        let result = {
            id: index + 1,
            value: convertToRoman(index + 1)
        }
        return result
    })
    let equivalent = result.map((item,index)=>{
        let result = {
            value: Number(item.maxPoint),
            name: convertToRoman(index + 1)
        }
        return result
    })
    return {feeZone, equivalent}
}

async function getRequirementPoints(id_paragraph, user_data=[]){
    let data = { 
        table : 'requirementsPoints',
        selector_name : 'id_paragraph',
        selector : id_paragraph,
    }
    let list = (await apiData({typeData:'read', data})).data
    list = list.map((item, index)=>{
        if(item.value=='') item.value = Math.round(Number(item.maxPoint)/2)
        let newItem = {
            id: index + 1,
            name_item: item.number,
            title: item.name,
            def_value: Number(item.value),
            max_value: Number(item.maxPoint),
            mim_value: Number(item.minPoint),
            user_title: '',
            value:"",
        }
        return newItem
    })

    let result =  { 
        name:'Fee zone',
        type_input: 'list_points',
        use: false,
        list,
        total:{
            title:'Summe der Punkte',
            value: 10,
            titele_equ: 'entspricht Honorarzone',
            equivalent: '|||',
        }
    }
    return result
}