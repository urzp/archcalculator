<template>
    <div class="page-wrap">
      <Header></Header>
      <AdminSiteBar @selected_item="value=>AdminSiteBar=value"></AdminSiteBar>
      <div class="top_to_scroll"  ref="to_scroll"></div>
      <div  class="main">
        <EditCalculator v-if="AdminSiteBar=='HOAI'"></EditCalculator>
        <AdminUsers v-if="AdminSiteBar=='Users'"></AdminUsers>
        <AdminProjects v-if="AdminSiteBar=='Projects'"></AdminProjects>
        <AdminBills v-if="AdminSiteBar=='Bills'"></AdminBills>
      </div>
      <Footer></Footer>
    </div>
</template>

<script>

export default {
    name: 'AdminPage',
    mounted(){
      document.body.classList.add('admin_page')
    },
    unmounted(){
      document.body.classList.remove('admin_page')
    },
    data(){
        return {
          AdminSiteBar: 'Users',
        }
    },

}
</script>

<style>
  .admin_page{
    background-color: #fffbeb;
  }
</style>

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