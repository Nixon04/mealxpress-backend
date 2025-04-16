<template>
  <transition name="fade-slide">
  <div class="main-board-mealxpress">
    <OrdersComplete :isVisible="isVisible"  @close="closeModal" :ModalData="ModalData" :loading="loading"/>
    <NavbarComponent />
    <div class="mealxpress-content">
      <HeaderDashboard :imageref="imageref" />
      <div class="mealxpress-mai">
     <!-- card figures to venture -->

    <div class="mb-4">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="row">
              <div class="col-lg-12">
                <!-- table contents -->

    <Tabs value="0" class="tablets custom-tabs px-3 m-2">
      <TabList class="bg-meal-tablist">
          <Tab value="0">All</Tab>
          <Tab value="1">Processing</Tab>
          <Tab value="2">Completed</Tab>
          <Tab value="3">Returns</Tab>
      </TabList>
      <TabPanels class="tablets px-0">
          <TabPanel value="0">
               <!-- Fixed Columns -->
        <div class="card p-2 bg-border-card">
          <div class="d-flex justify-content-between card">
            <h5 class="card-header bg-textmain fw-bold">All </h5>
            <div class="form-bod">
              <input
                type="text"
                class="form-control py-2"
                v-model="searchQuery"
                placeholder="Search your orders"
              />
            </div>
          </div>

          <div class="card-datatable text-nowrap table-responsive">
            <table class="dt-fixedcolumns table  ">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Portion</th>
                  <th>Drinks</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in data" :key="index.id" @click="ViewAllTogether(item)" class="cursor-pointer" >
                    <td >{{ item.username }}</td>
                    <td>{{ item.cartreference }}</td>
                    <td>{{ item.price }}</td>
                  <td class="rounded position-relative shift-body">
                    <span class="position-absolute bg-label-info rounded-md p-2 mx-2 me-3 shift-call">{{ item.portion }}</span>
                  </td>
                  <td>{{ item.cartdrink? item.cartdrink : 'No Drinks' }}</td>
                      <td class="rounded position-relative shift-body">
                        <span :class="{
                          'position-absolute bg-rx-success rounded-md p-2 shift-call': item.cartstatus == 'Delivered',
                          'position-absolute bg-rx-pending text-main rounded-md p-2 shift-call opacity-4': item.cartstatus == 'pending',
                          'position-absolute bg-rx-warning rounded-md p-2 shift-call': item.cartstatus == 'returns',
                          'position-absolute bg-rx-returns rounded-md p-2 shift-call': item.cartstatus == 'cancelled',
                         }">
                         {{ item.cartstatus }}</span>
                      </td>

                  <td>{{ item.cartpurchasedate }}</td>
                  <td @click="openModal(item)" class="d-flex align-items-center justify-content-center py-4 cursor-pointer">
                    <i class="fa-solid fa-ellipsis"></i>
                  </td>
                </tr>
              </tbody>
            </table>
            <div v-if="noResults" class="text-center py-4 bg-textmain">
              Mealxpress couldn't find any query data of this such {{ searchQuery }}
            </div>
          </div>

     

          <!-- Pagination Controls -->
          <div class="pagination mb-2 py-2 px-4">
          
            <span class="bg-textmain">Page {{ currentPage }} of {{ totalPages }}</span>
            <div class="d-flex gap-4">
              <select v-model="rowsPerPage" @change="changevaluestate" class="form-select w-20">
                <option v-for="option in dropOption" :key="option" :value="option">
                  {{ option }}
                </option>
              </select>
              <div class="d-flex gap-2">
                <button @click="prevPage" class="bg-textmain" :disabled="currentPage === 1">Previous</button>
                <button @click="nextPage" class="bg-textmain" :disabled="currentPage === totalPages">Next</button>
              </div>
              
            </div>
          </div>
        </div>
          </TabPanel>
          <TabPanel value="1">
            <div class="card bg-border-card px-3 py-3">
              <div class="d-flex justify-content-between card">
                <h5 class="card-header bg-textmain fw-bold">Processing Table</h5>
                <div class="form-bod">
                  <input
                    type="text"
                    class="form-control py-2"
                    v-model="searchQuery"
                    placeholder="Search your orders"
                  />
                </div>
              </div>
    
              <div class="card-datatable text-nowrap table-responsive">
                <table class="dt-fixedcolumns table  ">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Portion</th>
                      <th>Drinks</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="pendingtable.length === 0">
                      <td colspan="8" class="text-center">
                        No pending orders available.
                      </td>
                    </tr>
                    <tr v-for="(item, index) in pendingtable" :key="index.id" >
                      <td >{{ item.username }}</td>
                      <td>{{ item.cartreference }}</td>
                      <td>{{ item.price }}</td>
                      <td class="rounded position-relative shift-body">
                        <span class="position-absolute bg-label-info rounded-md p-2 mx-2 me-3 shift-call">{{ item.portion }}</span>
                      </td>
    
                      <td>{{ item.cartdrink? item.cartdrink : 'No Drinks' }}</td>
                          <td class="rounded position-relative shift-body"
                          
                            >
                            <span :class="{
                              'position-absolute bg-rx-success rounded-md p-2 shift-call': item.cartstatus == 'Delivered',
                              'position-absolute bg-rx-pending text-main rounded-md p-2 shift-call opacity-4': item.cartstatus == 'pending',
                              'position-absolute bg-rx-warning rounded-md p-2 shift-call': item.cartstatus == 'returns',
                              'position-absolute bg-rx-returns rounded-md p-2 shift-call': item.cartstatus == 'cancelled',
                             }">
                             
                             {{ item.cartstatus }}</span>
                          </td>
    
    
                      <td>{{ item.cartpurchasedate }}</td>
                      <td @click="openModal(item)" class="d-flex align-items-center justify-content-center py-4 cursor-pointer">
                        <i class="fa-solid fa-ellipsis"></i>
                      </td>
                    </tr>
                  </tbody>

                </table>
                <div v-if="noResults" class="text-center py-4 bg-textmain">
                  Mealxpress couldn't find any query data of this such {{ searchQuery }}
                </div>
              </div>
    
         
    
              <!-- Pagination Controls -->
              <div class="pagination mb-2 py-2 px-4">
              
                <span class="bg-textmain">Page {{ currentPage }} of {{ totalPages }}</span>
                <div class="d-flex gap-4">
                  <select v-model="rowsPerPage" @change="changevaluestate" class="form-select w-20">
                    <option v-for="option in dropOption" :key="option" :value="option">
                      {{ option }}
                    </option>
                  </select>
                  <div class="d-flex gap-">
                    <button @click="prevPage" class="bg-textmain" :disabled="currentPage === 1">Previous</button>
                    <button @click="nextPage" class="bg-textmain" :disabled="currentPage === totalPages">Next</button>
                  </div>
                  
                </div>
              </div>
            </div>
          </TabPanel>
          <TabPanel value="2">
            <div class="card bg-border-card px-3 py-3">
              <div class="d-flex justify-content-between card">
                <h5 class="card-header bg-textmain fw-bold">Completed Table</h5>
                <div class="form-bod">
                  <input
                    type="text"
                    class="form-control py-2"
                    v-model="searchQuery"
                    placeholder="Search your orders"
                  />
                </div>
              </div>
    
              <div class="card-datatable text-nowrap table-responsive">
                <table class="dt-fixedcolumns table  ">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Portion</th>
                      <th>Drinks</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="deliveredtable.length === 0">
                      <td colspan="8" class="text-center">
                        No Completed orders available.
                      </td>
                    </tr>
                    <tr v-for="(item, index) in deliveredtable" :key="index.id" >
                      <td >{{ item.username }}</td>
                      <td>{{ item.cartreference }}</td>
                      <td>{{ item.price }}</td>
                      <td class="rounded position-relative shift-body">
                        <span class="position-absolute bg-label-info rounded-md p-2 mx-2 me-3 shift-call">{{ item.portion }}</span>
                      </td>
    
                      <td>{{ item.cartdrink? item.cartdrink : 'No Drinks' }}</td>
                          <td class="rounded position-relative shift-body"
                          
                            >
                            <span :class="{
                              'position-absolute bg-rx-succes rounded-md p-2 shift-call': item.cartstatus == 'Delivered',
                              'position-absolute bg-rx-pending text-main rounded-md p-2 shift-call opacity-4': item.cartstatus == 'pending',
                              'position-absolute bg-rx-warning rounded-md p-2 shift-call': item.cartstatus == 'returns',
                              'position-absolute bg-rx-returns rounded-md p-2 shift-call': item.cartstatus == 'cancelled',
                             }">
                             
                             {{ item.cartstatus }}</span>
                          </td>
    
    
                      <td>{{ item.cartpurchasedate }}</td>
                      <td @click="openModal(item)" class="d-flex align-items-center justify-content-center py-4 cursor-pointer">
                        <i class="fa-solid fa-ellipsis"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div v-if="noResults" class="text-center py-4 bg-textmain">
                  Mealxpress couldn't find any query data of this such {{ searchQuery }}
                </div>
              </div>         
    
              <!-- Pagination Controls -->
              <div class="pagination mb-2 py-2 px-4">
              
                <span class="bg-textmain">Page {{ currentPage }} of {{ totalPages }}</span>
                <div class="d-flex gap-4">
                  <select v-model="rowsPerPage" @change="changevaluestate" class="form-select w-20">
                    <option v-for="option in dropOption" :key="option" :value="option">
                      {{ option }}
                    </option>
                  </select>
                  <div class="d-flex gap-">
                    <button @click="prevPage" class="bg-textmain" :disabled="currentPage === 1">Previous</button>
                    <button @click="nextPage" class="bg-textmain" :disabled="currentPage === totalPages">Next</button>
                  </div>
                  
                </div>
              </div>
            </div>
          </TabPanel>

          <TabPanel value="3">
            <div class="card bg-border-card px-3 py-3">
              <div class="d-flex justify-content-between card">
                <h5 class="card-header bg-textmain fw-bold ">Returns Table</h5>
                <div class="form-bod">
                  <input
                    type="text"
                    class="form-control py-2"
                    v-model="searchQuery"
                    placeholder="Search your orders"
                  />
                </div>
              </div>
    
              <div class="card-datatable text-nowrap table-responsive">
                <table class="dt-fixedcolumns table  ">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Portion</th>
                      <th>Drinks</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if="returnstable.length === 0">
                      <td colspan="8" class="text-center">
                        No Returns made available.
                      </td>
                    </tr>
                    <tr v-for="(item, index) in returnstable" :key="index.id" >
                      <td >{{ item.username }}</td>
                      <td>{{ item.cartreference }}</td>
                      <td>{{ item.price }}</td>
                      <td class="rounded position-relative shift-body">
                        <span class="position-absolute bg-label-info rounded-md p-2 mx-2 me-3 shift-call">{{ item.portion }}</span>
                      </td>
    
                      <td>{{ item.cartdrink? item.cartdrink : 'No Drinks' }}</td>
                          <td class="rounded position-relative shift-body"
                          
                            >
                            <span :class="{
                              'position-absolute bg-rx-success rounded-md p-2 shift-call': item.cartstatus == 'Delivered',
                              'position-absolute bg-rx-pending text-main rounded-md p-2 shift-call opacity-4': item.cartstatus == 'pending',
                              'position-absolute bg-rx-warning rounded-md p-2 shift-call': item.cartstatus == 'returns',
                              'position-absolute bg-rx-returns rounded-md p-2 shift-call': item.cartstatus == 'cancelled',
                             }">
                             
                             {{ item.cartstatus }}</span>
                          </td>
    
    
                      <td>{{ item.cartpurchasedate }}</td>
                      <td @click="openModal(item)" class="d-flex align-items-center justify-content-center py-4 cursor-pointer">
                        <i class="fa-solid fa-ellipsis"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div v-if="noResults" class="text-center py-4 bg-textmain">
                  Mealxpress couldn't find any query data of this such {{ searchQuery }}
                </div>
              </div>
    
         
    
              <!-- Pagination Controls -->
              <div class="pagination mb-2 py-2 px-4">
              
                <span class="bg-textmain">Page {{ currentPage }} of {{ totalPages }}</span>
                <div class="d-flex gap-4">
                  <select v-model="rowsPerPage" @change="changevaluestate" class="form-select w-20">
                    <option v-for="option in dropOption" :key="option" :value="option">
                      {{ option }}
                    </option>
                  </select>
                  <div class="d-flex gap-">
                    <button @click="prevPage"  class="bg-textmain" :disabled="currentPage === 1">Previous</button>
                    <button @click="nextPage" class="bg-textmain" :disabled="currentPage === totalPages">Next</button>
                  </div>
                  
                </div>
              </div>
            </div>
          </TabPanel>
      </TabPanels>
  </Tabs>
              </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-12 bg-col-dismiss d-none">
          <div class="col-lg-12 col-md-6 py-2 px-3">
            <div class="card p-2 mb-1 bg-order-card ">
              <div class="d-flex">
                <div class="bg-circle me-3 P-3">
                  <i class="fas fa-box p-3"></i>
                  </div>
                  <div class="d-flex flex-column gap  -1">
                    <h4>Orders</h4>
                    <h1 class="fs-1">Total {{orders ? orders : '0'}}</h1>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-6 px-3">
            <div class="card p-2 mb-1 bg-order-card ">
              <div class="d-flex">
                <div class="bg-circle me-3 P-3">
                  <i class="fas fa-box p-3"></i>
                  </div>
                  <div class="d-flex flex-column gap  -1">
                    <h4>Returnsdsd</h4>
                    <h1 class="fs-1">Total {{returns ? returns : '0'}}</h1>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-6 py-1 px-3">
            <div class="card p-2 mb-1 bg-order-card ">
              <div class="d-flex">
                <div class="bg-circle me-3 P-3">
                  <i class="fas fa-box p-3"></i>
                  </div>
                  <div class="d-flex flex-column gap  -1">
                    <h4>Delivered</h4>
                    <h1 class="fs-1">Total {{Delivered ? Delivered : '0'}}</h1>
                  </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-6 py-1 px-3">
            <div class="card p-2 mb-1 bg-order-card ">
              <div class="d-flex">
                <div class="bg-circle me-3 P-3">
                  <i class="fas fa-box p-3"></i>
                  </div>
                  <div class="d-flex flex-column gap  -1">
                    <h4>Cancelled</h4>
                    <h1 class="fs-1">Total {{cancelled ? cancelled : '0'}}</h1>
                  </div>
              </div>
            </div>
          </div>


        </div>
        </div>
        <!-- end for  -->
      </div>
    </div>
  </div>


      </div>
    </div>
  </div>
</transition>
</template>
<script>
import { ref, computed } from 'vue';
import ProgressBar from 'primevue/progressbar';

import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import NavbarComponent from './../../components/vendorsnav/aside.vue';
import HeaderDashboard from './../../components/vendorsnav/header.vue';
import OrdersComplete from './../../components/modals/orderscomplete.vue';
import '../../assets/mealxpresscustom/app.css';
import './../../assets/mealxpresscustom/media.css';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';
import Tab from 'primevue/tab';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';

export default {
  components: {
    NavbarComponent,
    HeaderDashboard,
    OrdersComplete,
    ProgressBar,
    Tabs,
    TabList,
    Tab,
    TabPanels,
    TabPanel,
  },
  setup() {
    const { props } = usePage();
    const data = ref(props.data || []);
    const orders = ref(props.orders || '');
    const Delivered = ref(props.Delivered || '');
    const returns = ref(props.returns || '');
    const Cancelled = ref(props.Cancelled || '');

    const datarefcall = ref(props.datareturns || []);
    const searchQuery = ref('');
    const rowsPerPage = ref(3); // Default rows per page
    const currentPage = ref(1);
    const dropOption = [3, 20, 50, 100];
    const isVisible = ref(false);
    const ModalData = ref(null);
    const loading = ref(false);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const pendingtable = ref(props.datareturns.pending);
    const deliveredtable = ref(props.datareturns.Delivered || []);
    const returnstable = ref(props.datareturns.returns || []);
    const imageref = ref(props.image || []);


    const ViewAllTogether = async (item) => {
      if(item.cartstatus == "returns" ||  item.cartstatus == "Delivered"){
        console.log('Cart Already rejected');
        return;
      }
      isVisible.value = true;
      loading.value = true;
      setTimeout(async () => {
        await fetchOrderList(item);
      }, 1000); 
    }
   
    const openModal = async (item) => {
      if(item.cartstatus == "returns"){
        console.log('Cart Already rejected');
        return;
      }
      isVisible.value = true;
      loading.value = true;
      setTimeout(async () => {
        await fetchOrderList(item);
      }, 1000);  // 3000 milliseconds = 3 seconds delay
    };

    const fetchOrderList = async (item) => {
      const payload = {
        itemid: item.cartrefcode,
         }
      try {
        
        loading.value = true;
        const response = await axios.post('/vendorspath/orderlistitems', payload, {
         headers:{
          'X-CSRF-TOKEN': csrfToken, 
         },
            },
      );
      ModalData.value = response.data.data;
      console.log(response.data.data);

      } catch (error) {
        console.error('Error fetching order details:', error);
      }
      finally{
        loading.value = false;
      }
    };
    const closeModal = () => {
      isVisible.value = false;
    };

    const filteredData = computed(() => {
      if (!data.value) return [];
      if (!searchQuery.value) return data.value;
      return data.value.filter((item) =>
        Object.values(item).some((val) =>
          String(val).toLowerCase().includes(searchQuery.value.toLowerCase())
        )
      );
    });

    const noResults = computed(() => filteredData.value.length === 0);

    const totalPages = computed(() => {
      return Math.ceil(filteredData.value.length / rowsPerPage.value);
    });

    const paginatedData = computed(() => {
      const start = (currentPage.value - 1) * rowsPerPage.value;
      const end = start + rowsPerPage.value;
      return filteredData.value.slice(start, end);
    });

    const nextPage = () => {
      if (currentPage.value < totalPages.value) currentPage.value++;
    };

    const prevPage = () => {
      if (currentPage.value > 1) currentPage.value--;
    };

    const changevaluestate = () => {
      currentPage.value = 1;
    };

    return {
      imageref,
      searchQuery,
      rowsPerPage,
      currentPage,
      changevaluestate,
      data,
      noResults,
      totalPages,
      paginatedData,
      nextPage,
      dropOption,
      prevPage,
      isVisible,
      closeModal,
      openModal,
      ModalData,
      loading,
      orders,
      Delivered,
      Cancelled,
      returns,
      datarefcall,
      pendingtable,
      deliveredtable,
      returnstable,
      ViewAllTogether,
    };
  },
};
</script>


<style scoped>
.pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.pagination button {
  padding: 8px 12px;
  cursor: pointer;
}

.pagination button[disabled] {
  cursor: not-allowed;
  opacity: 0.5;
}
</style>
