<template>
  <Head>
      <title>Mealxpress | Product Lists</title>
  </Head>
  <div class="main-board-mealxpress">
      <NavbarComponent />
      <div class="mealxpress-content">
        <HeaderDashboard/>
        <div class="mealxpress-main">
          <div class="card-general-container card p-2">
              <h1 class="fs-3 ms-2 py-2">Product List</h1>
              <!-- create our tab and fill components -->
              <Tabs value="0" class="tablets custom-tabs">
                  <TabList class="bg-meal-tablist">
                      <Tab value="0">Recent Orders</Tab>
                      <Tab value="1">Header II</Tab>
                      <Tab value="2">Header III</Tab>
                  </TabList>
                  <TabPanels class="tablets">
                      <TabPanel value="0">
                          <p class="m-0 text-dark">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                          </p>
                      </TabPanel>
                      <TabPanel value="1">
                          <p class="m-0 text-dark" >
                              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                              ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Consectetur, adipisci velit, sed quia non numquam eius modi.
                          </p>
                      </TabPanel>
                      <TabPanel value="2">
                          <p class="m-0">
                              At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa
                              qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus.
                          </p>
                      </TabPanel>
                  </TabPanels>
              </Tabs>
              
              
          </div>
       </div>
      </div>
  </div>  

</template>

<script>
import NavbarComponent from './../../components/vendorsnav/aside.vue';
import HeaderDashboard from './../../components/vendorsnav/header.vue';
import {Head}  from '@inertiajs/vue3'; 
import DatePicker from 'primevue/datepicker';
import Tabs from 'primevue/tabs';
  import TabList from 'primevue/tablist';
  import Tab from 'primevue/tab';
  import TabPanels from 'primevue/tabpanels';
  import TabPanel from 'primevue/tabpanel';


export default{
  components:{
      Tabs,
      TabList,
      Tab,
      TabPanels,
      TabPanel,
      NavbarComponent,
      HeaderDashboard,
      DatePicker,
  }
}

</script>
