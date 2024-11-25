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
    EventBus.on('MenuProjects:new', this.newProject)
    EventBus.on('Project:saveAsLocal', this.localProject)
  },
  data(){
    return {
      project_id: 'local',
    }
  },
  methods:{
    newProject(){
      this.project_id = 'new'
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




