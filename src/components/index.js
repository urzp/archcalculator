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
//----------------------------Detals_of_items-----------------------------
import FeeZoneDetal from './Calculator/Object/Parts/Detals_of_item/FeeZoneDetal.vue'
import EligibleCostsDetal from './Calculator/Object/Parts/Detals_of_item/EligibleCostsDetal.vue'
import FeeTableDetal from './Calculator/Object/Parts/Detals_of_item/FeeTableDetal.vue'
//----------------------------ItemPartsObject-----------------------------
import ItemPartObj from './Calculator/Object/Parts/Item/ItemPartObj.vue'
//----------------------------SelectLists-ItemPartsObject-----------------------------
import Select_List from './Calculator/Object/Parts/SelectLists_of_Items/Select_List.vue'
//-----------------------------UI------------------------------------
import Toggle from './UI/Toggle.vue'
import ToggleButton from './UI/ToggleBtn.vue'
import ToggleListButton from './UI/ToggleListBtn.vue'
import CloseButton from './UI/CloseBtn.vue'
import Price from './UI/Price.vue'
import Percent from './UI/Percent.vue'

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

    FeeZoneDetal,
    EligibleCostsDetal,
    FeeTableDetal,

    ItemPartObj,

    Select_List,
    
    Toggle,
    ToggleButton,
    ToggleListButton,
    CloseButton,
    Price,
    Percent,
]