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




