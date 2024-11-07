export function calculate(data){
    let basis = data.find(item=>item.name == 'Basis')
    let baseServis = data.find(item=>item.name == 'BaseServis')
    calculate_basis(basis)

}

function calculate_basis(basis){
    let Surcharge = basis.list.find(el=>el.name == 'Surcharge')
    let Fee_table = basis.list.find(el=>el.name == 'Fee according to fee table')
    Surcharge.price = Surcharge.value * 0.01 * Fee_table.value
    calculate_detals(basis, "Fee zone")
    calculate_detals(basis, "Eligible costs")
    calculate_fee_table_value(basis)
    basis.Total.value = Fee_table.value + Surcharge.price
}

function calculate_detals(data, item_name){
    if (!item_name) return false
    let element = data.list.find(el=>el.name == item_name)
    let detals = element.detail_input 
    let total = 0
    detals.list.forEach(element => {
        let val = element.value==''?element.def_value:element.value
        total = total + Number(val)
    });
    detals.total.value = total
    if(item_name=="Fee zone"){
        let equivalent = detals.equivalents.find(item => total < item.value);
        detals.total.equivalent = equivalent.name
        if(!element.use_select) element.value = equivalent.name
    }
    if(item_name=="Eligible costs"){
        if(!element.use_select) element.value = detals.total.value
    }
}

function calculate_fee_table_value(data){
    let element = data.list.find(el=>el.name == "Fee according to fee table")
    let Fee_Table = element.detail_input
    let min = Fee_Table.current.min_fee
    let max = Fee_Table.current.max_fee
    let el_free_rate = data.list.find(el=>el.name == "Fee rate")
    let name_val = el_free_rate.value
    let list = el_free_rate.list
    let fee_rate_procent = list.find(item => item.value == name_val).percent
    let fee_value = min + (max-min) * (fee_rate_procent/100)
    element.value = fee_value
}