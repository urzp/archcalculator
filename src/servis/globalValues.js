import { reactive } from 'vue';

export let global= reactive({
   login:false,
   admin:false,
})

export let user = reactive({
    id:localStorage.getItem('user_id'),
    name:localStorage.getItem('user_name'),
    email:localStorage.getItem('user_email'),
})

//window.global = global


export function getGlobal(){
    return global
}

export function setGlobalValue(name, value){
    global[name]=value
}
