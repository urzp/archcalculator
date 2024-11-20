export  async function apiData(rq_data = {}){
    let baseUrl = 'https://hosting209012.ae957.netcup.net/php/dataServis/index.php'
    //let baseUrl = 'https://arcalc.ru/php/dataServis/index.php';
    let url = baseUrl
    let user_id = localStorage.getItem('user_id')
    let token  = localStorage.getItem('user_token')
    // if (notValid(storageUser)||notValid(storageSession)) return false 
    // let user = await JSON.parse(storageUser)
    // let session = storageSession

    let data = {
        user_id,
        token,
        rq_data,
    }
    let response = await fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
    },
    body: JSON.stringify(data)
    });

    let result = await response.json();
    if(!result.data) result.data = []
    return result
}

function notValid(value){
    return !value||value == 'undefined'
}