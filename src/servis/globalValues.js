import { reactive } from 'vue';

export let global= reactive({
   login:false,
   admin:false,
   openPopapProjects:false,
   newProject:false,
   base_url:'https://hosting209012.ae957.netcup.net',
})

export let user = reactive({
    id:localStorage.getItem('user_id'),
    name:localStorage.getItem('user_name'),
    email:localStorage.getItem('user_email'),
    token:localStorage.getItem('user_token'),
    token:localStorage.getItem('user_phone'),
})

//window.global = global


export function getGlobal(){
    return global
}

export function setGlobalValue(name, value){
    global[name]=value
}
