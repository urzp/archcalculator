export let Parts_items_detail_input = {
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