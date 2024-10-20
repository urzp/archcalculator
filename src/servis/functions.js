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