import { lists } from '@/servis/selectLists.js'
import { Parts_items_detail_input } from '@/servis/Parts_items_detail.js'
export function getData(){
    return data
}

let data = {

    Basis:{
        "HOAI version": {type: 'text', value: 2021, list:lists.HOAT_v},
        "Planning object":{type: 'text', value: '§34G Gebäude', list:lists.Planing_Object },
        "Fee zone":{type: 'text', value: 'III', list:lists.Fee_Zone, detail_input: Parts_items_detail_input.Fee_Zone},
        "Fee rate":{type: 'text', value: 'Mittelsatz', list:lists.Middle_set},
        "Eligible costs":{type: 'price', value:450000, detail_input: Parts_items_detail_input.Eligible_Costs},
        "Fee according to fee table":{type: 'price', value: 64236.50, detail_input: Parts_items_detail_input.Fee_Table},
        "Surcharge":{type:'count_percent', value: 1, price: 0},
        "Total":{value:0, percent:100},
    },
    lists,
   
}



