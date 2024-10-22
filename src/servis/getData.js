import { apiData } from '@/servis/apiData.js'
import { getHOAIData } from '@/servis/getHOAIData.js'
import { newData } from '@/servis/newData.js'
import { lists } from '@/servis/selectLists.js'
import { Parts_items_detail_input } from '@/servis/Parts_items_detail.js'
export async function getData(selected){
    selected =''
    if(!selected){selected = await getDefaulData()}

    let HOAIData = await getHOAIData(selected)
    let Basis = await  newData(HOAIData)

    let data = [ 
        Basis,
        {
            id: '2',
            name:'BaseServis',
            list:[
                {id: 1, name: "Basic research", type: 'count_percent_default', input_type: true, value: 2, default_value: 2, price: 0}
            ],
            Total:{value:0, percent:100},
    },
    ]

    return data
}

async function getDefaulData(){
    let data = { 
        table : 'settings',
        selector_name : 'name',
        selector : 'default_paragraph',
    }
    let default_paragraph = (await apiData({typeData:'read', data})).data[0]
    data = { 
        table : 'paragraphs',
        selector_name : 'id',
        selector : default_paragraph.value,
    }
    
    let paragraph = (await apiData({typeData:'read', data})).data[0]
    let id_HOAI_v = paragraph.id_HOAI
    return {id_HOAI_v, id_paragraph: paragraph.id}
} 