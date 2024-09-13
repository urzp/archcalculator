//----------------------------Page-----------------------------------
import Header from './PageParts/Header.vue'
import Footer from './PageParts/Footer.vue'
//----------------------------Calculator-----------------------------
import Calculator from './Calculator/Calc.vue'
import ObjectCalc from './Calculator/Object/ObjectCalc.vue'
import TotalCalc from './Calculator/TotalCalc.vue'
//----------------------------Object--------------------------------
import ObjectTitile from './Calculator/Object/title.vue'
import ObjectTotal from './Calculator/Object/total.vue'
//----------------------------PartsObject-----------------------------
import PartObjectTitle from './Calculator/Object/Parts/title.vue'
import PartObjectTotal from './Calculator/Object/Parts/total.vue'
import Basis from './Calculator/Object/Parts/Basis.vue'
import BaseServis from './Calculator/Object/Parts/BaseServis.vue'
//----------------------------ItemPartsObject-----------------------------
import ItemSubObj from './Calculator/Object/Parts/Item/ItemSubObj.vue'
//-----------------------------UI------------------------------------
import Toggle from './UI/Toggle.vue'
import ToggleButton from './UI/ToggleBtn.vue'
import CloseButton from './UI/CloseBtn.vue'
import Price from './UI/Price.vue'

export default [
    Header,
    Footer,

    Calculator,
    ObjectCalc,
    TotalCalc,

    ObjectTitile,
    ObjectTotal,


    PartObjectTitle,
    PartObjectTotal,
    Basis,
    BaseServis,

    ItemSubObj,
    
    Toggle,
    ToggleButton,
    CloseButton,
    Price,
]