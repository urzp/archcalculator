import { lastElement } from '@/servis/functions.js'
import { Parts_items_detail_input } from '@/servis/Parts_items_detail.js'
import { lists } from '@/servis/selectLists.js'
export async function newData(HOAIData){
    let result = {}
    
    let Basis = {
        id: '1',
        name:'Basis',
        list:[
            {id: '1', name: "HOAI version" , type: 'text', value: HOAIData.HOAI_value, list:HOAIData.HOAT_list},
            {id: '2', name: "Planning object", type: 'text', value: HOAIData.paragraph, list:HOAIData.paragraphs },
            {id: '3', name: "Fee zone", type: 'text', value: HOAIData.feeZone[0].value, list: HOAIData.feeZone, detail_input: HOAIData.requirementPoints},
            {id: '4', name: "Fee rate", type: 'text', value: 'Mittelsatz', list:lists.Middle_set},
            {id: '5', name: "Eligible costs", type: 'price', input_type: true , use_select: true , value:450000, detail_input: Parts_items_detail_input.Eligible_Costs},
            {id: '6', name: "Fee according to fee table", type: 'price', value: 64236.50, detail_input: Parts_items_detail_input.Fee_Table},
            {id: '7', name: "Surcharge", type:'count_percent', input_type: true , value: 1, price: 0},
        ],
        Total:{value:0, percent:100},
    }
    
    return Basis
}