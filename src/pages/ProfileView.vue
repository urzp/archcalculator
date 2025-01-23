<template>
    <div class="page-wrap">
      <Header></Header>
        <Profile/>
      <Footer></Footer>
    </div>
  </template>
  
  <script>
  
  export default {
    name: 'PrifileView',
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
  
  
  
  
  