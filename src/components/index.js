//----------------------------Page-----------------------------------
import Header from './PageParts/Header.vue'
import Footer from './PageParts/Footer.vue'
//----------------------------Calculator-----------------------------
import Calculator from './Calculator/Calc.vue'
import ObjectCalc from './Calculator/_Object/ObjectCalc.vue'
import ResultCalc from './Calculator/ResultObjects/2_ResultCalc.vue'
//----------------------------Object--------------------------------
import Titile_Object from './Calculator/_Object/Titile_Object.vue'
import Total_Object from './Calculator/_Object/Total_Object.vue'
//----------------------------Basis-----------------------------
import Basis from './Calculator/_Object/01_Basis/00_Basis.vue'
import HOAI_version_calc  from './Calculator/_Object/01_Basis/01_HOAI_version.vue'
import Paragraph_calc  from './Calculator/_Object/01_Basis/02_Paragraph.vue'
import HonorarZone_calc  from './Calculator/_Object/01_Basis/03_HonorarZone.vue'
import HonorarRate_calc  from './Calculator/_Object/01_Basis/04_HonorarRate.vue'
import Finance_calc  from './Calculator/_Object/01_Basis/05_Finance.vue'
import Honorar_calc from './Calculator/_Object/01_Basis/06_Honorar.vue'
import PayExtra_calc from './Calculator/_Object/01_Basis/07_PayExtra.vue'
import TotalBasis from './Calculator/_Object/01_Basis/08_TotalBasis.vue'
//----------------------------BaseServis-----------------------------
import BaseServis from './Calculator/_Object/02_BaseServis/00_BaseServis.vue'
import Stage_calc from './Calculator/_Object/02_BaseServis/01_Stage.vue'
import Stage_calc_L0 from './Calculator/_Object/02_BaseServis/02_Stage_L0.vue'
import Stage_calc_L1 from './Calculator/_Object/02_BaseServis/02_Stage_L1.vue'
import TotalBasisServis from './Calculator/_Object/02_BaseServis/03_TotalBasisServis.vue'
//----------------------------BaseServis-----------------------------
import SpecialServices from './Calculator/_Object/03_SpecialServices/00_SpecialServices.vue'
import ItemSpetialServis from './Calculator/_Object/03_SpecialServices/01_ItemSpetialServis.vue'
//----------------------------PartsObject-----------------------------
import Title_SubObjec from './Calculator/_Object/00_UI/01_Title_SubObject.vue'
import Content_PartObject from './Calculator/_Object/00_UI/02_Content_PartObject.vue'

//----------------------------Detals_of_items-----------------------------
import HonorarZoneDetal from './Calculator/_Object/01_Basis/Detals_of_item/01_HonorarZoneDetal.vue'
import FinanceDetal from './Calculator/_Object/01_Basis/Detals_of_item/02_FinanceDetal.vue'
import HonorarDetal from './Calculator/_Object/01_Basis/Detals_of_item/03_HonorarDetal.vue'
//----------------------------ResultObjects-----------------------------
import Titile_Result from './Calculator/ResultObjects/1_Titile_Result.vue'
import AdditionalServices from './Calculator/ResultObjects/01_AdditionalServices/00_AdditionalServices.vue'
import ItemAdditionalServis from './Calculator/ResultObjects/01_AdditionalServices/01_ItemAdditionalServis.vue'
import Total_Result from './Calculator/ResultObjects/3_Total_Result.vue'
import TotalAdditionalServis from './Calculator/ResultObjects/01_AdditionalServices/03_TotalAdditionalServis.vue'
import ExtraCosts from './Calculator/ResultObjects/02_ExtraCosts/00_ExtraCosts.vue' 
import ItemExtraCost from './Calculator/ResultObjects/02_ExtraCosts/01_ItemExtraCost.vue'
import TotalExtraCosts from './Calculator/ResultObjects/02_ExtraCosts/03_TotalExtraCosts.vue'
import Summary from './Calculator/ResultObjects/03_Summary/00_Summary.vue'
import TotalNet from './Calculator/ResultObjects/03_Summary/01_TotalNet.vue'
import TotalTax from './Calculator/ResultObjects/03_Summary/02_TotalTax.vue'
import Total from './Calculator/ResultObjects/03_Summary/03_Total.vue'
import TotalSummary from './Calculator/ResultObjects/03_Summary/04_TotalSummary.vue'
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
import Select_List from './UI/Select_List.vue'
import SelectEdit_List from './UI/SelectEdit_List.vue'
import ContextMenu from './UI/ContextMenu.vue'

export default [
    Header,
    Footer,

    Calculator,
    ObjectCalc,
    ResultCalc,

    Titile_Object,
    Total_Object,

    Title_SubObjec,
    Content_PartObject,


    Basis,
    HOAI_version_calc,
    Paragraph_calc,
    HonorarZone_calc,
    HonorarRate_calc,
    Finance_calc,
    Honorar_calc,
    PayExtra_calc,
    TotalBasis,

    BaseServis,
    Stage_calc,
    Stage_calc_L0,
    Stage_calc_L1,
    TotalBasisServis,

    SpecialServices,
    ItemSpetialServis,

    HonorarZoneDetal,
    FinanceDetal,
    HonorarDetal,

    RequirementsPoints,

    Titile_Result,
    AdditionalServices,
    ItemAdditionalServis,
    TotalAdditionalServis,
    ExtraCosts,
    ItemExtraCost,
    TotalExtraCosts,
    Total_Result,
    Summary,
    TotalNet,
    TotalTax,
    Total,
    TotalSummary,
    
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
    Select_List,
    SelectEdit_List,
    ContextMenu,
]