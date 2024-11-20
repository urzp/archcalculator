import { reactive } from 'vue';

export let global= reactive({
   login:false,
   admin:false,
})

window.global = global


export function getGlobal(){
    return global
}

export function setGlobalValue(name, value){
    global[name]=value
}
