import { apiData } from '@/servis/apiData.js'

let result  = await apiData({typeData:'Paragraphs', id_HOAI: 2})
let Planing_Object = result.data.map(item=>{return { id:item.id, value: `${item.name} ${item.title}` } })


export let lists = {

    Planing_Object,

    Fee_Zone:[
        {id:1,value:'I'},
        {id:2,value:'II'},
        {id:3,value:'III'},
        {id:4,value:'IV'},
        {id:5,value:'V'},
    ],
    Middle_set:[
        {id:1,value:'Basissatz', percent:0},
        {id:2,value:'Viertelsatz', percent:25},
        {id:3,value:'Mittelsatz', percent:50},
        {id:4,value:'Dreiviertelsatz', percent:75},
        {id:5,value:'Höchstsatz', percent:100},
        {id:6,value:'Prozent eingeben', percent:0},
    ],
}