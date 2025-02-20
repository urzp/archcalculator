<template>
  <div class="page-wrap">
    <Header></Header>
    <SiteBar v-if="is_login"></SiteBar>
    <div class="top_to_scroll"  ref="to_scroll"></div>
    <div v-if="showMain" class="main">
      <Calculator v-show="!show_bills" :class="{hide_block:show_bills}" :project_id="project_id" :statusBill="statusBill" :download_token="download_token"></Calculator>
      <ProjBills v-show="show_bills" :class="{hide_block:!show_bills}" :project_id="project_id"></ProjBills>
    </div>
    <div v-else class="veiews">
        <Impressum v-if="selectedView=='impressum'"/>
        <Datenschutz v-if="selectedView=='datenschutz'" />
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { global } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'
export default {
  name: 'HomePage',
  mounted(){
    this.init()
    EventBus.on('Project:saveAsLocal', this.localProject)
    EventBus.on('Project:newProjectUser', id => this.project_id = id)
    EventBus.on('Project:openProject', id => this.openProject(id))
    EventBus.on('Project:openBill', id => this.openBill(id))
    EventBus.on('MenuProjects:openLocal', ()=>this.project_id = 'local')
    EventBus.on('MenuProjects:showBills', ()=>this.show_bills=true)
    EventBus.on('MenuProjects:closeBills', ()=>this.show_bills=false)
    EventBus.on('Project:ErrLoadeded', this.ErrorLoad)
    EventBus.on('Footer:selectMain', ()=>{this.showMain=true; this.scrollUp()})
    EventBus.on('Footer:selectView', name=>this.selectView(name) )
    this.confirmEmail()
    
  },
  data(){
    return {
      project_id: 'local',
      statusBill: false,
      show_bills: false,
      download_token: '',
      showMain: true,
      selectedView: '',
      text:{
        Project_not_find: text.pupaps.Project_not_find,
        Wrong_confirmation_email: text.pupaps.Wrong_confirmation_email,
        Email_confirmed: text.pupaps.Email_confirmed,
        Email_already_confirmed: text.pupaps.Email_already_confirmed,
      }
    }
  },
  computed:{
    is_login(){ return  global.login }
  },
  methods:{
    async init(){
      if(await this.use_link_project()){
        if(!!this.$route.query.project) this.project_id = this.$route.query.project; this.statusBill=false
        if(!!this.$route.query.bill) this.project_id = this.$route.query.bill; this.statusBill=true
        this.download_token = this.$route.query.download_token
      }else{
        let id = localStorage.getItem('OpendProject') 
        if(!!id&&global.login){ this.project_id = id }else{ this.project_id = 'local' }
      }
    },
    async use_link_project(){
      if(!this.$route.query.download_token) return false
      let id_download_project = this.$route.query.project
      let download_token = this.$route.query.download_token
      let result = await apiData({typeData:'isAvailableDownload',  data:{ id_download_project, download_token } })
      return true// result.success
    },
    openProject(id){
      this.project_id = id
      this.statusBill = false
      this.download_token = ''
      localStorage.setItem('OpendProject',id) 
    },
    openBill(id){
      this.project_id = id
      this.statusBill = true
      this.show_bills=false
      this.download_token = ''
    },
    ErrorLoad(){
      EventBus.emit('Menu:Message', this.text.Project_not_find)
      localStorage.removeItem('OpendProject') 
      this.project_id = 'local'
    },
    localProject(){
      this.project_id = 'local'
    },
    async confirmEmail(){
      if(!this.$route.query||!this.$route.query.email||!this.$route.query.code) return false
      let email = this.$route.query.email
      let code = this.$route.query.code
      let result = await apiData({typeData:'comfirmEmail', data:{email, code}})
      if(!result.success){ EventBus.emit('Menu:Message', this.text.Wrong_confirmation_email) }
      if(result.success){ 
        if(result.data.email_confirmed == '0') EventBus.emit('Menu:Message', this.text.Email_confirmed) 
        if(result.data.email_confirmed == '1') EventBus.emit('Menu:Message', this.text.Email_already_confirmed) 
      }
    },
    selectView(name){
      this.selectedView=name; 
      this.showMain=false
      this.scrollUp()
    },
    scrollUp(){
      this.$refs.to_scroll.scrollIntoView({ behavior: "smooth" });
    }
  }
  
}
</script>

<style scoped>
  .page-wrap{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .veiews{
    margin-top: 60px;
    margin-bottom: 60px;
  }
</style>




