export  async function apiData(rq_data = {}){
    let baseUrl = 'https://arcalc.ru/php/dataServis/index.php';
    let url = baseUrl
    // let storageUser = sessionStorage.getItem('user')
    // let storageSession  = sessionStorage.getItem('session')
    // if (notValid(storageUser)||notValid(storageSession)) return false 
    // let user = await JSON.parse(storageUser)
    // let session = storageSession

    let data = {
        //user_id:user.id,
        //session,
        rq_data
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