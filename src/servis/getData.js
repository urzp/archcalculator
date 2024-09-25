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
        {id:1,val:'Basissatz', percent:0},
        {id:2,val:'Viertelsatz', percent:25},
        {id:3,val:'Mittelsatz', percent:50},
        {id:4,val:'Dreiviertelsatz', percent:75},
        {id:5,val:'Höchstsatz', percent:100},
        {id:6,val:'Prozent eingeben', percent:0},
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
                    user_title: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,
                },
                {
                    id:'2',
                    name_item: 'functional_area',
                    title:'Number of functional areas',
                    user_title: '',
                    def_value: 3,
                    value:'',
                    max_value: 9,
                    min_value:0,           
                },
                {
                    id:'3',
                    name_item: 'design_requirements',
                    title:'Design requirements',
                    user_title: '',
                    def_value: 3,
                    value:'',
                    max_value: 9,
                    min_value:0,           
                },
                {
                    id:'4',
                    name_item: 'constructive',
                    title:'Constructive requirements',
                    user_title: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,           
                },
                {
                    id:'5',
                    name_item: 'technical_equipment',
                    title:'Technical equipment',
                    user_title: '',
                    def_value: 3,
                    value:'',
                    max_value: 6,
                    min_value:0,           
                },
                {
                    id:'6',
                    name_item: 'Expansion',
                    title:'Expansion',
                    user_title: '',
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

    },
    Eligible_Costs:{
        name:'Eligible costs',
        use: false,
        list: [
            {
                id:'1',
                title:'KG200 Preparatory measures',
                user_title: '',
                def_value: 0,
                value:'',
            },
            {
                id:'2',
                title:'KG300 Building - Building construction',
                user_title: '',
                def_value: 0,
                value:'',
            },
            {
                id:'3',
                title:'KG400 Building - Technical facilities',
                user_title: '',
                def_value: 0,
                value:'',
            },
            {
                id:'4',
                title:'KG500 Outdoor facilities and open spaces',
                user_title: '',
                def_value: 0,
                value:'',
            },
            {
                id:'5',
                title:'KG600 Equipment and artwork',
                user_title: '',
                def_value: 0,
                value:'',
            },
        ],
        total:{
            title:'Total eligible costs, "other"',
            value: 10000,
        },
    },
    Fee_Table:{
        name:'Fee according to fee table',
        low:{
            funding: 300000.00,
            min_fee: 39981.00 ,
            max_fee: 49864.00 
        },
        current:{
            funding: 450000.00,
            min_fee: 57170.25,
            max_fee: 71302.75 
        },
        up:{
            funding: 500000.00,
            min_fee: 62900.00,
            max_fee: 78449.00 
        }
    },
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
        "Total":{value:0, percent:100}
    },
    lists,
}



