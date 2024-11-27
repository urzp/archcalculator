import { dateToString } from '@/servis/functions.js'
import { reactive } from 'vue';

export let newProjectData = {
    id: 'new',
    created: dateToString(new Date),
    updated: dateToString(new Date),
    user_id: localStorage.getItem('user_id'),
    name: 'New Projec',
    AdditionalServices:[],
    ExtraCosts:[],
    total_AdditionalServices:0,
    total_ExtraCosts:0,
    tax: 19,
    total_tax: 0,
    total_net: 0,
    total: 0,
}

export let newObjectProject = {
    user_id:localStorage.getItem('user_id'),
    project_id: 'new',
    name: 'New Object',
    HOAI_version_id:2,
    paragraph_id:8,
    honorarLevel: {id:30,number:1,value:"Honorarzone I",usePoints:false},
    honorarLevelDetals:[{value: 5},{value: 7},{value: 6 },{value: 4},{value: 3},{value: 2}],
    HonorarRate:{id:3,value:"Mittelsatz",percent:50},
    finance:{value: 450000,useDetals: false, detals:[], userTitle:[]},
    payExtra:{percent:0},
    specialServices:[],
    spetial_servis_total:0,
}

export let newWholeProject = reactive ( {
    project: newProjectData,
    objects: [
        newObjectProject,
    ]
} )

