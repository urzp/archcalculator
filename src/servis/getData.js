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

let Parts_items_detail_input = {
    Fee_Zone: { 
        name:'Fee zone',
        type_input: 'list_points',
        use: false,
        list: [
                {
                    id:'1',
                    name_item: 'environment',
                    title:'Requirements for integration into the environment',
                    user_comment: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,
                },
                {
                    id:'2',
                    name_item: 'functional_area',
                    title:'Number of functional areas',
                    user_comment: '',
                    def_value: 3,
                    value:'',
                    max_value: 9,
                    min_value:0,           
                },
                {
                    id:'3',
                    name_item: 'design_requirements',
                    title:'Design requirements',
                    user_comment: '',
                    def_value: 3,
                    value:'',
                    max_value: 9,
                    min_value:0,           
                },
                {
                    id:'4',
                    name_item: 'constructive',
                    title:'Constructive requirements',
                    user_comment: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,           
                },
                {
                    id:'5',
                    name_item: 'technical_equipment',
                    title:'Technical equipment',
                    user_comment: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,           
                },
                {
                    id:'6',
                    name_item: 'Expansion',
                    title:'Expansion',
                    user_comment: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,           
                },

            ],
        equivalents:[
            { name:"I", value: 10 },
            { name:"II", value: 19 },
            { name:"III", value: 26 },
            { name:"IV", value: 35 },
            { name:"V", value: 100 },
        ], 
        total:{
            title:'Summe der Punkte',
            value: 10,
            titele_equ: 'entspricht Honorarzone',
            equivalent: '|||',
        }

    }
}

let data = {

    Basis:{
        "HOAI version": {type: 'text', value: 2021, list:lists.HOAT_v},
        "Planning object":{type: 'text', value: '§34G Gebäude', list:lists.Planing_Object },
        "Fee zone":{type: 'text', value: 'III', list:lists.Fee_Zone, detail_input: Parts_items_detail_input.Fee_Zone},
        "Fee rate":{type: 'text', value: 'Middle set', list:lists.Middle_set},
        "Eligible costs":{type: 'price', value:0},
        "Fee according to fee table":{type: 'price', value:1000},
        "Surcharge":{type:'count_percent', value: 10.5, price: 0}
    },
    lists,
}



