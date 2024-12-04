<template>
  <div class="page-wrap">
    <Header></Header>
    <Calculator :project_id="project_id"></Calculator>
    <Footer></Footer>
  </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'HomeView',
  mounted(){
    this.init()
    EventBus.on('Project:saveAsLocal', this.localProject)
    EventBus.on('Project:newProjectUser', id => this.project_id = id)
    EventBus.on('Project:openProject', id => this.project_id = id)
  },
  data(){
    return {
      project_id: 'local',
    }
  },
  methods:{
    init(){
      let localProject = localStorage.getItem('Project') 
      if(!!localProject){
        let id = JSON.parse(localProject).project.id
        this.project_id = id
      }else{
        this.project_id = 'local'
      }
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




