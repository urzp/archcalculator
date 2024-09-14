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
import PartObjectContent from './Calculator/Object/Parts/content.vue'
import PartObjectTotal from './Calculator/Object/Parts/total.vue'
import Basis from './Calculator/Object/Parts/Basis.vue'
import BaseServis from './Calculator/Object/Parts/BaseServis.vue'
//----------------------------ItemPartsObject-----------------------------
import ItemPartObj from './Calculator/Object/Parts/Item/ItemPartObj.vue'
//----------------------------SelectLists-ItemPartsObject-----------------------------
import SelList_HOAT_Ver from './Calculator/Object/Parts/SelectLists_of_Items/HOAI_ver_List.vue'
//-----------------------------UI------------------------------------
import Toggle from './UI/Toggle.vue'
import ToggleButton from './UI/ToggleBtn.vue'
import ToggleListButton from './UI/ToggleListBtn.vue'
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
    PartObjectContent,
    PartObjectTotal,
    Basis,
    BaseServis,

    ItemPartObj,

    SelList_HOAT_Ver,
    
    Toggle,
    ToggleButton,
    ToggleListButton,
    CloseButton,
    Price,
]