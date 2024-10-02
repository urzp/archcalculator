<template>
    <div class="page-wrap">
      <Header></Header>
      <EditCalculator></EditCalculator>
      <Footer></Footer>
    </div>
  </template>
  
  <script>
  
  export default {
    name: 'LawEditView',
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