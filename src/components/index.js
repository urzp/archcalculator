//----------------------------Page-----------------------------------
import Header from './PageParts/Header.vue'
import Footer from './PageParts/Footer.vue'
import Menu from './PageParts/Menu.vue'
import Popaps from './UI/Pupaps/00_Pupaps.vue'
import Comfirm from './UI/Pupaps/confirm.vue'
import openProject from './UI/Pupaps/openProject.vue'
import ListAllprojects from './UI/Pupaps/openProject/ListAllprojects.vue'
import ListRecentProjects from './UI/Pupaps/openProject/ListRecentProjects.vue'
import ListDayProjects from './UI/Pupaps/openProject/ListDayProjects.vue'
import ShowProject from './UI/Pupaps/openProject/ShowProject.vue'
import Calendar from './UI/Pupaps/openProject/Calendar.vue'
import messagePopap from './UI/Pupaps/message.vue'
import downloadLinks from './UI/Pupaps/downloadLinks.vue'
//----------------------------User-----------------------------------
import Login from './Users/Login.vue'
import Registration from './Users/Registration.vue'
import ResetPassword from './Users/ResetPassword.vue'
import Profile from './Users/Profile.vue'
import EditUserFeeld from './Users/EditUserFeeld.vue'
import EditPassword from './Users/EditPassword.vue'
//----------------------------Calculator-----------------------------
import CalcTitle from './Calculator/Calc_title.vue'
import Calculator from './Calculator/Calc.vue'
import ObjectCalc from './Calculator/Object/ObjectCalc.vue'
import ResultCalc from './Calculator/ResultObjects/2_ResultCalc.vue'
//----------------------------Object--------------------------------
import Titile_Object from './Calculator/Object/Titile_Object.vue'
import Total_Object from './Calculator/Object/Total_Object.vue'
//----------------------------Basis-----------------------------
import Basis from './Calculator/Object/01_Basis/00_Basis.vue'
import HOAI_version_calc  from './Calculator/Object/01_Basis/01_HOAI_version.vue'
import Paragraph_calc  from './Calculator/Object/01_Basis/02_Paragraph.vue'
import HonorarZone_calc  from './Calculator/Object/01_Basis/03_HonorarZone.vue'
import HonorarRate_calc  from './Calculator/Object/01_Basis/04_HonorarRate.vue'
import Finance_calc  from './Calculator/Object/01_Basis/05_Finance.vue'
import Honorar_calc from './Calculator/Object/01_Basis/06_Honorar.vue'
import PayExtra_calc from './Calculator/Object/01_Basis/07_PayExtra.vue'
import TotalBasis from './Calculator/Object/01_Basis/08_TotalBasis.vue'
//----------------------------BaseServis-----------------------------
import BaseServis from './Calculator/Object/02_BaseServis/00_BaseServis.vue'
import Stage_calc from './Calculator/Object/02_BaseServis/01_Stage.vue'
import Stage_calc_L0 from './Calculator/Object/02_BaseServis/02_Stage_L0.vue'
import Stage_calc_L1 from './Calculator/Object/02_BaseServis/02_Stage_L1.vue'
import TotalBasisServis from './Calculator/Object/02_BaseServis/03_TotalBasisServis.vue'
//----------------------------BaseServis-----------------------------
import SpecialServices from './Calculator/Object/03_SpecialServices/00_SpecialServices.vue'
import ItemSpetialServis from './Calculator/Object/03_SpecialServices/01_ItemSpetialServis.vue'
//----------------------------PartsObject-----------------------------
import Title_SubObjec from './Calculator/Object/00_UI/01_Title_SubObject.vue'
import Content_PartObject from './Calculator/Object/00_UI/02_Content_PartObject.vue'

//----------------------------Detals_of_items-----------------------------
import HonorarZoneDetal from './Calculator/Object/01_Basis/Detals_of_item/01_HonorarZoneDetal.vue'
import FinanceDetal from './Calculator/Object/01_Basis/Detals_of_item/02_FinanceDetal.vue'
import HonorarDetal from './Calculator/Object/01_Basis/Detals_of_item/03_HonorarDetal.vue'
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
//----------------------------Bills--------------------------------------
import Bill from './Bill/bill.vue'
import BillsList from './Bill/BillsList.vue'
import BillHeader from './Bill/01_BillHeader.vue'
import Grundleistungen from './Bill/02_Grundleistungen.vue'
import BillBasicServices from './Bill/Grundleistugen/01_BillBasicServices.vue'
import BillLeistungsstand from './Bill/Grundleistugen/02_BillLeistungsstand.vue'
import BillBesondereLeistungen from './Bill/Grundleistugen/03_BillBesondereLeistungen.vue'
import BillAdditionalLeistungen from './Bill/03_AdditionalLeistungen.vue'
import BillTotalObject from './Bill/Grundleistugen/04_BillTotalObject.vue'
import Nebenkosten from './Bill/04_Nebenkosten.vue'
import Zwischensumme from './Bill/05_Zwischensumme.vue'
import GesamtRest from './Bill/06_GesamtRest.vue'
import AdvancePayments from './Bill/GesamtRest.vue/AdvancePayments.vue'
import Rechnungsbetrag from './Bill/07_Rechnungsbetrag.vue'
import BillFooter from './Bill/08_Footer.vue'
import ExportPanel from './Bill/09_Export.vue'
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
import Toggle from './UI/Simples/Toggle.vue'
import ToggleButton from './UI/Simples/ToggleBtn.vue'
import Button from './UI/Simples/Button.vue'
import ToggleListButton from './UI/Simples/ToggleListBtn.vue'
import NewButton from './UI/Simples/NewBtn.vue'
import UpdateBtn from './UI/Simples/UpdateBtn.vue'
import CloseButton from './UI/Simples/CloseBtn.vue'
import DeleteButton from './UI/Simples/DeleteBtn.vue'
import UpButton from './UI/Simples/UpBtn.vue'
import DownButton from './UI/Simples/DownBtn.vue'
import PastColumButton from './UI/Simples/PastColumBtn.vue'
import Price from './UI/Simples/Price.vue'
import PriceBill from './UI/Simples/PriceBill.vue'
import PriceInputBill from './UI/Simples/PriceInputBill.vue'
import Price_Bill from './UI/Simples/Price_bill.vue'
import Percent from './UI/Simples/Percent.vue'
import InputDate from './UI/Simples/InputDate.vue'
import InputYear from './UI/Simples/InputYear.vue'
import InputText from './UI/Simples/InputText.vue'
import InputNumber from './UI/Simples/InputNumber.vue'
import InputHours_Bill from './UI/Simples/InputHours_Bill.vue'
import InputText_Bill from './UI/Simples/InputText_Bill.vue'
import ImputTextMLine from './UI/Simples/ImputTextMLine.vue'
import ImputTextMLine_Bill from './UI/Simples/ImputTextMLine_Bill.vue'
import InputPrice from './UI/Simples/InputPrice.vue'
import Select_List from './UI/Simples/Select_List.vue'
import SelectEdit_List from './UI/Simples/SelectEdit_List.vue'
import ContextMenu from './UI/Simples/ContextMenu.vue'

export default [
    Header,
    Footer,
    Menu,
    Popaps,
    Comfirm,
    openProject,
    ListRecentProjects,
    ListAllprojects,
    ListDayProjects,
    ShowProject,
    Calendar,
    messagePopap,
    downloadLinks,

    Login,
    Registration,
    ResetPassword,
    Profile,
    EditUserFeeld,
    EditPassword,

    CalcTitle,
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

    Bill,
    BillsList,
    BillHeader,
    Grundleistungen,
    BillBasicServices,
    BillLeistungsstand,
    BillBesondereLeistungen,
    BillAdditionalLeistungen,
    BillTotalObject,
    Nebenkosten,
    Zwischensumme,
    GesamtRest,
    AdvancePayments,
    Rechnungsbetrag,
    BillFooter,
    ExportPanel,
    
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
    Button,
    PastColumButton,
    Price,
    PriceBill,
    PriceInputBill,
    Price_Bill,
    InputDate,
    Percent,
    InputYear,
    InputText,
    InputNumber,
    InputText_Bill,
    InputHours_Bill,
    ImputTextMLine,
    ImputTextMLine_Bill,
    InputPrice,
    Select_List,
    SelectEdit_List,
    ContextMenu,
]