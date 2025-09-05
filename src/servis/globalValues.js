import { reactive } from 'vue';
import { isLogget } from '@/components/Users/servis'

export let global = reactive({
   login:false,
   admin:false,
   isTariffActive: false,
   uploadPageFlag: false,
   openPopapProjects:false,
   newProject:false,
   base_url:'https://honorar.online',
   wideBody: document.querySelector('body').offsetWidth, 
})

export let user = reactive({
    id:localStorage.getItem('user_id'),
    name:localStorage.getItem('user_name'),
    email:localStorage.getItem('user_email'),
    token:localStorage.getItem('user_token'),
    phone:localStorage.getItem('user_phone'),
})

window.global = global
window.user =  user
uploadPage()

window.addEventListener('resize', () => {
    global.wideBody = document.querySelector('body').offsetWidth
})

export function getGlobal(){
    return global
}

export function setGlobalValue(name, value){
    global[name]=value
}

export function uploadPage(){
    window.addEventListener('focus', () => { 
        if(global.uploadPageFlag) {
            global.uploadPageFlag = false
            isLogget()
        }
    });
}