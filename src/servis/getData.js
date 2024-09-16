export function getData(){
    return data
}

let lists = {
    HOAT_v:[
        {id:1,val:2002},
        {id:2,val:2009},
        {id:3,val:2013},
        {id:4,val:2021},
    ],

    Planing_Object:[
        {id:1,val:'§18 Flächennutzungsplan'},
        {id:2,val:'§19 Bebauungsplan'},
        {id:3,val:'§23 Landschaftsplan'},
        {id:4,val:'§24 Grünordnungsplan'},
        {id:5,val:'§25 Landschaftsrahmenplan'},
        {id:6,val:'§26 Landschaftspflegerischer Begleitplan'},
        {id:7,val:'§27 Leistungsbild Pflege- und Entwicklungsplan'},
        {id:8,val:'§34G Gebäude'},
        {id:10,val:'§34I Innenräume'},
        {id:11,val:'§39 Freianlagen'},
        {id:12,val:'§43 Ingenieurbauwerke'},
    ],
    Fee_Zone:[
        {id:1,val:'I'},
        {id:2,val:'II'},
        {id:3,val:'III'},
        {id:4,val:'IV'},
        {id:5,val:'V'},
    ],
    Middle_set:[
        {id:1,val:'Basissatz'},
        {id:2,val:'Viertelsatz'},
        {id:3,val:'Mittelsatz'},
        {id:4,val:'Dreiviertelsatz'},
        {id:5,val:'Höchstsatz'},
        {id:5,val:'Prozent eingeben'},
    ],
}

let data = {

    Basis:{
        "HOAI version": {type: 'text', value: 2021, list:lists.HOAT_v},
        "Planning object":{type: 'text', value: '§34G Gebäude', list:lists.Planing_Object},
        "Fee zone":{type: 'text', value: 'III', list:lists.Fee_Zone},
        "Fee rate":{type: 'text', value: 'Middle set', list:lists.Middle_set},
        "Eligible costs":{type: 'price', value:0}
    },
    lists,
}



