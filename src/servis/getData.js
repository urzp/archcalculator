import { lists } from '@/servis/selectLists.js'
import { Parts_items_detail_input } from '@/servis/Parts_items_detail.js'
export function getData(){
    return data
}

let data = [ 
    {
        id: '1',
        name:'Basis',
        list:[
            {id: '1', name: "HOAI version" ,type:  'text', value: 2021, list:lists.HOAT_v},
            {id: '2', name: "Planning object", type: 'text', value: '§34G Gebäude', list:lists.Planing_Object },
            {id: '3', name: "Fee zone", type: 'text', value: 'III', list:lists.Fee_Zone, detail_input: Parts_items_detail_input.Fee_Zone},
            {id: '4', name: "Fee rate", type: 'text', value: 'Mittelsatz', list:lists.Middle_set},
            {id: '5', name: "Eligible costs", type: 'price', input_type: true , use_select: true , value:450000, detail_input: Parts_items_detail_input.Eligible_Costs},
            {id: '6', name: "Fee according to fee table", type: 'price', value: 64236.50, detail_input: Parts_items_detail_input.Fee_Table},
            {id: '7', name: "Surcharge", type:'count_percent', input_type: true , value: 1, price: 0},
        ],
        Total:{value:0, percent:100},
    },
    {
        id: '2',
        name:'BaseServis',
        list:[
            {id: 1, name: "Basic research", type: 'count_percent_default', input_type: true, value: 2, default_value: 2, price: 0}
        ],
        Total:{value:0, percent:100},
   },
]



