<template>
    <div class="page-wrap">
      <Header></Header>
      <AdminSiteBar @selected_item="value=>AdminSiteBar=value"></AdminSiteBar>
      <div class="top_to_scroll"  ref="to_scroll"></div>
      <div  class="main">
        <EditCalculator v-if="AdminSiteBar=='HOAI'"></EditCalculator>
        <AdminUsers v-if="AdminSiteBar=='Users'"></AdminUsers>
      </div>
      <Footer></Footer>
    </div>
</template>

<script>

export default {
    name: 'AdminPage',
    data(){
        return {
          AdminSiteBar: 'Users',
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