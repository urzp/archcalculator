<template>
  <div class="page-wrap">
    <Header></Header>
    <Calculator :project_id="project_id"></Calculator>
    <Footer></Footer>
  </div>
</template>

<script>

export default {
  name: 'HomeView',
  data(){
    return {
      project_id: '1',
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




