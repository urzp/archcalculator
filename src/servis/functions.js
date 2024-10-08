export function lastNumber(list, number='number'){
    if (!list.length||list.length == 0) return 0
    let last = list[list.length-1]
    return Number(last[number])
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

export async function getClipboard() {
    let data = await navigator.clipboard.readText()
    data = data.replaceAll(' ', '')
    data = data.split(/\r?\n/)
    data = data.filter(function(item){return !!item});
    if( !!data.find(function(item){return !Number(item)})) return []
    return data
}

export async function rateFillData(id_paragraph, index, rate_values, data) {
    let lastIndex = rate_values.length - 1
    let number = 1
    let newData = []
    rate_values.forEach(item=>{
        newData.push(item)
    })
    data.forEach(item=>{
        if(index <= lastIndex){
            newData[index].value = item
            number = Number(rate_values[index].number)
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
