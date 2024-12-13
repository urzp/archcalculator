<template>
  <div class="page-wrap">
    <Header></Header>
    <Calculator v-show="!show_bills" :class="{hide_block:show_bills}" :project_id="project_id"></Calculator>
    <Bill v-show="show_bills" :class="{hide_block:!show_bills}" :project_id="project_id"></Bill>
    <Footer></Footer>
  </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { global } from '@/servis/globalValues.js'
import { apiData } from '@/servis/apiData.js'

export default {
  name: 'HomeView',
  mounted(){
    this.init()
    EventBus.on('Project:saveAsLocal', this.localProject)
    EventBus.on('Project:newProjectUser', id => this.project_id = id)
    EventBus.on('Project:openProject', id => this.openProject(id))
    EventBus.on('MenuProjects:openLocal', ()=>this.project_id = 'local')
    EventBus.on('Project:ErrLoadeded', this.ErrorLoad)
    this.confirmEmail()
    
  },
  data(){
    return {
      project_id: 'local',
      show_bills: false,
    }
  },
  methods:{
    init(){
      if(!!localStorage.getItem('Project') ) { this.project_id = 'local'; return true }
      let id = localStorage.getItem('OpendProject') 
      if(!!id&&global.login){ this.project_id = id }else{ this.project_id = 'local' }
    },
    openProject(id){
      this.project_id = id
      localStorage.setItem('OpendProject',id) 
    },
    ErrorLoad(){
      EventBus.emit('Menu:Message', 'Das Projekt wurde nicht gefunden')
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
      let result = await apiData({typeData:'comfirmEmail',data:{email, code}})
      if(!result.success){ EventBus.emit('Menu:Message', 'Falscher Bestätigungs-Email-Link') }
      if(result.success){ 
        if(result.data.email_confirmed == '0') EventBus.emit('Menu:Message', 'E-Mail bestätigt') 
        if(result.data.email_confirmed == '1') EventBus.emit('Menu:Message', 'Bereits E-Mail bestätigt') 
      }
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
</style>




