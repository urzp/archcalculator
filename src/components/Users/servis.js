import { global, user } from '@/servis/globalValues.js'

export function logOut(){
    localStorage.setItem('user_id', '');
    localStorage.setItem('user_email', '');
    localStorage.setItem('user_name', '');
    localStorage.setItem('user_token', '');
    global.login = false
    global.admin = false
}

export function logIn(data){
    localStorage.setItem('user_id', data.id);
    localStorage.setItem('user_email', data.email);
    localStorage.setItem('user_name', data.name);
    localStorage.setItem('user_token', data.token);
    for (let key in data) {
        user[key] = data[key];
      }
    global.login = true
    if(data.level == 'admin' ) { global.admin = true }else{ global.admin = false }

}