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
//----------------------------SubObject-----------------------------
import SubObject from './Calculator/SubObject/SubObject.vue'
import SubObjectTitle from './Calculator/SubObject/title.vue'
import SubObjectTotal from './Calculator/SubObject/total.vue'
import Basis from './Calculator/SubObject/Basis.vue'
import BaseServis from './Calculator/SubObject/BaseServis.vue'
//----------------------------SubObject-----------------------------
import ItemSubObj from './Calculator/SubObject/Items/ItemSubObj.vue'
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

    SubObject,
    SubObjectTitle,
    SubObjectTotal,
    Basis,
    BaseServis,

    ItemSubObj,
    
    Toggle,
    ToggleButton,
    CloseButton,
    Price,
]