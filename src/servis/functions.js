
export function intToFloat(num, decPlaces) { 
    if(!num) num=0
    return num.toFixed(decPlaces); 
}

export function lastNumber(list, number='number'){
    if (!list.length||list.length == 0) return 0
    let last = list[list.length-1]
    return Number(last[number])
}

export function lastElement(list){
    if (!list||!list.length) return false
    return list[list.length - 1]
}

export function convertToRoman(number) {
    return [
        { value: 1000, char: 'M' },
        { value: 900, char: 'CM' },
        { value: 500, char: 'D' },
        { value: 400, char: 'CD' },
        { value: 100, char: 'C' },
        { value: 90, char: 'XC' },
        { value: 50, char: 'L' },
        { value: 40, char: 'XL' },
        { value: 10, char: 'X' },
        { value: 9, char: 'IX' },
        { value: 5, char: 'V' },
        { value: 4, char: 'IV' },
        { value: 1, char: 'I' }
    ].reduce((result, currentValue) => {
        while (number >= currentValue.value) {
            result += currentValue.char;
            number -= currentValue.value;
        }
        return result;
    }, '');
}

export async function getClipboard(type='number') {
    let data = await navigator.clipboard.readText()
    if(type=='number') data = data.replaceAll(' ', '')
    data = data.split(/\r?\n/)
    data = data.filter(function(item){return !!item});
    if(type=='number') data = data.map(item=>item.replace(/,/, '.'))
    if(type=='number') if( !!data.find(function(item){return !Number(item)})) return []
    return data
}

export async function rateFillData(id_paragraph, index, source, data) {
    let lastIndex = source.length - 1
    let number = 1
    let newData = []
    source.forEach(item=>{
        newData.push(item)
    })
    data.forEach(item=>{
        if(index <= lastIndex){
            newData[index].value = item
            number = Number(source[index].number)
        }else{
            newData.push({
                id:'new',
                id_paragraph,
                number,
                value:item,
            })
        }
        number++
        index++
    })
    return newData
}

export async function rateZoneFillData(index_rate, index_zone, source, data){
    let newData = []
    source.forEach( (item, index) =>{
        let id_rate_zone, value
        if( index >= index_rate){
            id_rate_zone = item.zones[index_zone].id
            value = data[index - index_rate]
            newData.push({id:id_rate_zone,value})
        }
    })
    return newData
}

export function toLetters(num) {
    "use strict";
    var mod = num % 26,
        pow = num / 26 | 0,
        out = mod ? String.fromCharCode(96 + mod) : (--pow, 'Z');
    return pow ? toLetters(pow) + out : out;
}

export function formatDate(data_time_string){
    if(!data_time_string) return ''
    let result
    let options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
      };
    result = data_time_string.split(' ')[0]
    result = new Date(result)
    result = result.toLocaleString("de", options)
    return result
}

export function dateToString(d){
    return d.toISOString().replace('T', ' ').replace('Z', '')
}

export function dateToStringNoTime(d){
   return formatDate(dateToString(d))
}

export function validateEmail(email){
    return !!String(email)
      .toLowerCase()
      .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};


export function validatePhone(phone){
    return !!String(phone)
        .match(
            /^[\d\+][\d\(\)\ -]{4,14}\d$/
        )
}

export function isSameDate(day_1, day_2){
    return day_1.getDate()==day_2.getDate()&&day_1.getMonth()==day_2.getMonth()&&day_1.getYear()==day_2.getYear()
}


export function array_move(arr, old_index, new_index) {
    if (new_index >= arr.length) {
        var k = new_index - arr.length + 1;
        while (k--) {
            arr.push(undefined);
        }
    }
    arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
    return arr; // for testing
};

export function useHover(){
   if (window.matchMedia("(pointer: coarse)").matches) {  
        if(window.screen.width < 900) return true
        return false
    } else {  
        return true
    } 
}

export function detectBrowser() {  
    const userAgent = navigator.userAgent.toLowerCase();  
    if (userAgent.indexOf('firefox') > -1) {  
        return 'Firefox';  
    }  
    else if (userAgent.indexOf('chrome') > -1) {  
        return 'Chrome';  
    }  
    else if (userAgent.indexOf('safari') > -1) {  
        return 'Safari';  
    }  
    else if (userAgent.indexOf('opera') > -1 || userAgent.indexOf('opr') > -1) {  
        return 'Opera';  
    }  
    else if (userAgent.indexOf('msie') > -1 || userAgent.indexOf('trident') > -1) {  
        return 'Internet Explorer';  
    }  
    else {  
        return 'Unknown';  
    }  
}  
