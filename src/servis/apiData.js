import { global } from '@/servis/globalValues.js'

export  async function apiData(rq_data = {}){
    //let baseUrl = 'https://hosting209012.ae957.netcup.net/php/dataServis/index.php'
    let baseUrl = global.base_url+'/php/dataServis/index.php'
    let url = baseUrl
    let user_id = localStorage.getItem('user_id')
    let token  = localStorage.getItem('user_token')

    if(rq_data.typeData=='avatar'){
        let data = rq_data.data
        data.append('SendFile', true)
        data.append('typeData', rq_data.typeData)
        data.append('user_id', user_id)
        data.append('token', token)
        let response = await fetch(url, {
            method: 'POST',
            body: data,
        })
        return response
    }else{
    let data = {
        user_id,
        token,
        rq_data,
    }
    let response = await fetch(url, {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
    body: JSON.stringify(data)
    });

    let result = await response.json();
    if(!result.data) result.data = []
    return result

    }
}

function notValid(value){
    return !value||value == 'undefined'
}