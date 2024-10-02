export let Low_Data = {
    id:'1',
    year: 2021,
    sections:[{
        id:'39',
        name_title: 'Freianlagen',
        name_paragraf:'§39',
        link_low_Basic_research: 'https://www.gesetze-im-internet.de/hoai_2013/__39.html',
        link_low_fee_table: 'https://www.gesetze-im-internet.de/hoai_2013/__40.html',
        fee_table:{
            type_initial_data: 'eur',
            list:[
                {id:1, initial:25000, fee_zones:[3882, 4624, 5366, 6108, 6793, 7535]},
                {id:2, initial:35000, fee_zones:[4981, 5933, 6885, 7837, 8716, 9668]},
                {id:3, initial:50000, fee_zones:[6487, 7727, 8967, 10207, 11352, 12592]},
                {id:4, initial:75000, fee_zones:[8759, 10434, 12108, 13783,	15328, 17003]},
                {id:5, initial:100000, fee_zones:[10839, 12911,	14983,	17056,	18968,	21041]},
            ]
        },
        fee_zones:[
            {id:1, name:'Anforderungen an die Einbindung in die Umgebung', min: 1, max: 6 },
            {id:2, name:'Anzahl der Funktionsbereiche', min: 1, max: 9 },
            {id:3, name:'gestalterische Anforderungen', min: 1, max: 9 },
            {id:4, name:'konstruktive Anforderungen', min: 1, max: 6 },
            {id:5, name:'technische Ausrüstung', min: 1, max: 6 },
            {id:6, name:'Ausbau', min: 1, max: 6 },
        ],
        fee_zone_corresponds:[
            {id:1, name:'I', max:10 },
            {id:2, name:'II', max:18 },
            {id:3, name:'III', max:26 },
            {id:4, name:'IV', max:34 },
            {id:5, name:'V', max:42 },
        ],
    }]

}