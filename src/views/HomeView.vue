<template>
  <div class="page-wrap">
    <Header></Header>
    <Calculator :project_id="project_id"></Calculator>
    <Footer></Footer>
  </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
import { global } from '@/servis/globalValues.js'
export default {
  name: 'HomeView',
  mounted(){
    this.init()
    EventBus.on('Project:saveAsLocal', this.localProject)
    EventBus.on('Project:newProjectUser', id => this.project_id = id)
    EventBus.on('Project:openProject', id => this.openProject(id))
    EventBus.on('MenuProjects:openLocal', ()=>this.project_id = 'local')
    EventBus.on('Project:ErrLoadeded', this.ErrorLoad)
  },
  data(){
    return {
      project_id: 'local',
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
      EventBus.emit('Menu:Message', 'The project not found')
      localStorage.removeItem('OpendProject') 
      this.project_id = 'local'
    },
    localProject(){
      this.project_id = 'local'
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




