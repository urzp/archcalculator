<template>
    <div class="page-wrap">
      <Header></Header>
      <AdminSiteBar></AdminSiteBar>
      <Footer></Footer>
    </div>
</template>

<script>
export default {
    name: 'AdminPage',
    data(){
        return {
        }
    },

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