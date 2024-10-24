//----------------------------Page-----------------------------------
import Header from './PageParts/Header.vue'
import Footer from './PageParts/Footer.vue'
//----------------------------Calculator-----------------------------
import Calculator from './Calculator/Calc.vue'
import ObjectCalc from './Calculator/_Object/ObjectCalc.vue'
import TotalCalc from './Calculator/TotalCalc.vue'
//----------------------------Object--------------------------------
import ObjectTitile from './Calculator/Object/title.vue'
import ObjectTotal from './Calculator/Object/total.vue'
//----------------------------Basis-----------------------------
import Basis from './Calculator/_Object/Basis/00_Basis.vue'
import HOAI_version_calc  from './Calculator/_Object/Basis/01_HOAI_version.vue'
import Paragraph_calc  from './Calculator/_Object/Basis/02_Paragraph.vue'
import HonorarZone_calc  from './Calculator/_Object/Basis/03_HonorarZone.vue'
//----------------------------PartsObject-----------------------------
import PartObjectTitle from './Calculator/Object/Parts/title.vue'
import PartObjectContent from './Calculator/Object/Parts/content.vue'
import PartObjectTotal from './Calculator/Object/Parts/total.vue'
import BaseServis from './Calculator/Object/Parts/BaseServis.vue'
//----------------------------Detals_of_items-----------------------------
import FeeZoneDetal from './Calculator/_Object/Basis/Detals_of_item/01_FeeZoneDetal.vue'
import EligibleCostsDetal from './Calculator/Object/Parts/Detals_of_item/EligibleCostsDetal.vue'
import FeeTableDetal from './Calculator/Object/Parts/Detals_of_item/FeeTableDetal.vue'
//----------------------------ItemPartsObject-----------------------------
import ItemPartObj from './Calculator/Object/Parts/Item/ItemPartObj.vue'
//----------------------------SelectLists-ItemPartsObject-----------------------------
import Select_List from './Calculator/Object/Parts/SelectLists_of_Items/Select_List.vue'
//----------------------------EditCalculator-----------------------------
import TopFixMenu from './EditCalculator/TopFixMenu.vue'
import EditCalculator from './EditCalculator/01_EditCalc.vue'
import HOAIVersion from './EditCalculator/02_HOAIVersion.vue'
import ParagraphHOAI from './EditCalculator/03_ParagraphHOAI.vue'
import AllowableCosts from './EditCalculator/04_AllowableCosts.vue'
import FeeTable from './EditCalculator/05_FeeTable.vue'
import RequirementsPoints from './EditCalculator/06_RequirementsPoints.vue'
import HonorarZone from './EditCalculator/07_HonorarZone.vue'
import Stages from './EditCalculator/08_Stages.vue'
import SubStage from './EditCalculator/09_SubStage.vue'
import SubStage_L1 from './EditCalculator/10_SubStage_L1.vue'
//-----------------------------UI------------------------------------
import Toggle from './UI/Toggle.vue'
import ToggleButton from './UI/ToggleBtn.vue'
import ToggleListButton from './UI/ToggleListBtn.vue'
import NewButton from './UI/NewBtn.vue'
import UpdateBtn from './UI/UpdateBtn.vue'
import CloseButton from './UI/CloseBtn.vue'
import DeleteButton from './UI/DeleteBtn.vue'
import UpButton from './UI/UpBtn.vue'
import DownButton from './UI/DownBtn.vue'
import PastColumButton from './UI/PastColumBtn.vue'
import Price from './UI/Price.vue'
import Percent from './UI/Percent.vue'
import InputYear from './UI/InputYear.vue'
import InputText from './UI/InputText.vue'
import ImputTextMLine from './UI/ImputTextMLine.vue'
import InputPrice from './UI/InputPrice.vue'
import SelectEdit_List from './UI/SelectEdit_List.vue'
import ContextMenu from './UI/ContextMenu.vue'

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
    HOAI_version_calc,
    Paragraph_calc,
    HonorarZone_calc,

    BaseServis,

    FeeZoneDetal,
    EligibleCostsDetal,
    FeeTableDetal,
    RequirementsPoints,

    ItemPartObj,

    Select_List,
    
    TopFixMenu,
    EditCalculator,
    HOAIVersion,
    ParagraphHOAI,
    AllowableCosts,
    FeeTable,
    HonorarZone,
    Stages,
    SubStage,
    SubStage_L1,
    
    Toggle,
    ToggleButton,
    ToggleListButton,
    NewButton,
    UpdateBtn,
    CloseButton,
    DeleteButton,
    UpButton,
    DownButton,
    PastColumButton,
    Price,
    Percent,
    InputYear,
    InputText,
    ImputTextMLine,
    InputPrice,
    SelectEdit_List,
    ContextMenu,
]