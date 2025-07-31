<template>
    <div class="page-wrap">
      <Header></Header>
      <AdminSiteBar @selected_item="value=>AdminSiteBar=value"></AdminSiteBar>
      <div class="top_to_scroll"  ref="to_scroll"></div>
      <div v-if="showMain" class="main">
        <EditCalculator v-if="AdminSiteBar=='HOAI'"></EditCalculator>
        <AdminUsers v-if="AdminSiteBar=='Users'"></AdminUsers>
        <AdminProjects v-if="AdminSiteBar=='Projects'"></AdminProjects>
        <AdminBills v-if="AdminSiteBar=='Bills'"></AdminBills>
        <AdminTariffs v-if="AdminSiteBar=='Tariffs'"></AdminTariffs>
        <EditPage v-if="hideEditPage" :namePage="AdminSiteBar"></EditPage>
      </div>
      <div v-show="!showMain" class="veiews">
        <PageInf :namePage="selectedView"/>
      </div>
      <Footer></Footer>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
    name: 'AdminPage',
    mounted(){
      document.body.classList.add('admin_page')
      EventBus.on('Footer:selectMain', ()=>{this.showMain=true; this.scrollUp()})
      EventBus.on('Footer:selectView', name=>this.selectView(name) )
    },
    unmounted(){
      document.body.classList.remove('admin_page')
    },
    data(){
        return {
          AdminSiteBar: 'Users',
          showMain: true,
          selectedView: '',
        }
    },
    methods:{
      selectView(name){
        this.selectedView=name; 
        this.showMain=false
        this.scrollUp()
      },
      scrollUp(){
        if(this.$refs.to_scroll) this.$refs.to_scroll.scrollIntoView({ behavior: "smooth" });
      }
    },
    computed:{
      hideEditPage(){
        let result = true
        if(this.AdminSiteBar=='HOAI') result=false
        if(this.AdminSiteBar=='Users') result=false
        if(this.AdminSiteBar=='Projects') result=false
        if(this.AdminSiteBar=='Bills') result=false
        if(this.AdminSiteBar=='Tariffs') result=false
        return result
      }
    }

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