import { global } from '@/servis/globalValues.js'

export function logOut(){
    localStorage.setItem('user_id', '');
    localStorage.setItem('user_email', '');
    localStorage.setItem('user_name', '');
    localStorage.setItem('user_token', '');
    global.login = false
    global.admin = false
}

export function logIn(user){
    localStorage.setItem('user_id', user.id);
    localStorage.setItem('user_email', user.email);
    localStorage.setItem('user_name', user.name);
    localStorage.setItem('user_token', user.token);
    global.login = true
    if(user.level == 'admin' ) { global.admin = true }else{ global.admin = false }

}