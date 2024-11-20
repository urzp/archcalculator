export let global= {
   login:false,
   admin:false,
}

export function getGlobal(){
    return global
}

export function setGlobalValue(name, value){
    global[name]=value
}
