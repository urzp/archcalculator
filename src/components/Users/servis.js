import { global, user } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
import { EventBus } from '@/servis/EventBus'

export function logOut(){
    localStorage.setItem('user_id', '');
    localStorage.setItem('user_email', '');
    localStorage.setItem('user_updated', '');
    localStorage.setItem('user_name', '');
    localStorage.setItem('user_phone', '');
    localStorage.setItem('user_token', '');
    global.login = false
    global.admin = false
    EventBus.emit('Menu:logOut')
}

export function logIn(data){
    setNewDataProfile(data)
}

function setNewDataProfile(data){
    localStorage.setItem('user_id', data.id);
    localStorage.setItem('user_updated', data.updated);
    localStorage.setItem('user_email', data.email);
    localStorage.setItem('user_name', data.name);
    localStorage.setItem('user_phone', data.phone);
    localStorage.setItem('user_token', data.token);
    for (let key in data) {
        user[key] = data[key];
      }
    global.login = true
    if(data.level == 'admin' ) { global.admin = true }else{ global.admin = false }
}

export async function updatedProfile(){
    if(!global.login) return false
    let updated = localStorage.getItem('user_updated')
    let result = await apiData({typeData:'isUserUpdated', data:updated })
    //if(result.success){ setNewDataProfile(result.data) }
    setNewDataProfile(result.data)
}

export async function isLogget(){
    let result = await apiData({typeData:'isLogin' })
    global.login = result.success
    if(result.success) { 
        global.admin = result.isAdmin; 
        global.isTariffActive=result.isTariffActive 
    }else{
        global.admin = false; 
        global.isTariffActive = false
    }
    // global.isTariffActive = false
    if(result.success) updatedProfile()
    return result.success
}