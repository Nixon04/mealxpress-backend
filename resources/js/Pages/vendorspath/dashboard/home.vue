<template>
    <div class="main-board-mealxpress">
      <TransferInit :stablevisible="stablevisible" @close="dismissmodalclear" :populatebanks="populatebanks" />
      <VisibleCharts :chartvisible="chartvisible" :totalsum="totalsum" :salescount="salescount" @close="dismisscharts"/>
      <NavbarComponent />
      <div class="mealxpress-content">
        <HeaderDashboard/>
        <div class="mealxpress-main">
           <div class="row">
            <div class="col-lg-12 ">
              <div class="col-lg-12 col-12 mb-5">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex flex-column">
                    <h1 class="fs- bg-textmain bg-f-1">Dashboard</h1>
                     <h6>Here's your dashboard sales details overview</h6>
                   </div>
                  <div class="d-flex">
                    <Button @click="showcharts" class="bg-button-submit btn p-3 m-3 py-2 bg-display-charts">
                      Charts
                    </Button>
                    <Button  @click="showtransfermodel" class="bg-button-submit btn p-3 m-3 py-2 ">
                      Transfer
                    </Button>
                  </div> 
                </div>
              </div>
              <div class="col-12">
                <div class="card bg-fix-card bg-row-background bg-border-card mb-3">
                  <div class="text-center">
                    <span class="text-muted fw-bold">Mealxpress wallet</span>
                  </div>
                  <div class="d-flex gap-3 align-items-center">
                  <span v-if="!isBalanceVisible" class="bg-f-2 fw-bold bg-textmain">₦*********</span>
                    <h1 v-show="isBalanceVisible" class="bg-f-2 fw-bold bg-textmain">₦{{formatCurrency(mainbalance)}}</h1>
                    <i @click="toggleVisibility"  :class="['fas', 'fs-4', 'cursor-pointer', 'bg-textmain', iconClass]"></i>
                  </div>
                </div>
              </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12 bg-display-flex">
                        <div class="row">
                            <div class="col-lg-6 col-12 ">
                                <div class="card  gap-1 shadow-none card-outline mb-3">
                                   <div class="d-flex justify-content-between mb-2 px-5 p-2">
                                    <h1 class="fs-4 fw-bold bg-textmain">Total Sales</h1>
                                      <div class="bg-circle border-circle">
                                        <i class="fa-solid fa-ellipsis"></i>
                                      </div>
                                   </div>
                                   <div class="div-centered mb-3 px-5 p-2">
                                    <h1 class="fs-4 fw-bold mb-3 bg-textmain"> ₦{{ formatCurrency(totalsum) }} </h1>
                                    <div class="d-flex">
                                      <div class="bg-auto-rate me-2">
                                        <i class="fa-solid fa-arrow-up-long"></i>
                                        +5%
                                      </div>
                                      <span>Vs Last Month</span>
                                    </div>
                                   </div>
                                  <Link href="">
                                    <div class="card bg-lightgrey px-4 p-1 m-0">
                                      <div class="d-flex justify-content-between align-items-center p-3">
                                        <h6>View More</h6>
                                        <div class="bg-circle">
                                          <i class="fa-solid fa-chevron-right"></i>
                                        </div>
                                      </div>
                                     </div>
                                   </Link>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="card  gap-1 shadow-none card-outline mb-3">
                                 <div class="d-flex justify-content-between mb-2 px-5 p-2">
                                  <h1 class="fs-4 bg-textmain fw-bold">Total Orders</h1>
                                    <div class="bg-circle border-circle">
                                      <i class="fa-solid fa-ellipsis"></i>
                                    </div>
                                 </div>
                                 <div class="div-centered mb-3 px-5 p-2">
                                  <h1 class="fs-4 fw-bold mb-3 bg-textmain"> {{formatCurrency(salescount)}}</h1>
                                  <div class="d-flex">
                                    <div class="bg-auto-rate me-2">
                                      <i class="fa-solid fa-arrow-up-long"></i>
                                      +5%
                                    </div>
                                    <span>Vs Last Month</span>
                                  </div>
                                 </div>
                                <Link href="">
                                  <div class="card bg-lightgrey px-4 p-1 m-0 shadow-none">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                      <h6>View More</h6>
                                      <div class="bg-circle">
                                        <i class="fa-solid fa-chevron-right"></i>
                                      </div>
                                    </div>
                                   </div>
                                 </Link>
                              </div>
                          </div>
                            <div class="col-lg-12 mb-3">
                              <div class="card p-4 bg-label-success">
                                <div class="d-flex justify-content-between">
                                  <h1 class="fs-2 fw-bold bg-textmain">Customer Activities</h1>
                                  <h6>+239</h6>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <!-- recent updated request -->
                    <div class="col-lg-12 col-md-12">
                      <div class="card">
                        <div class="card-body">
                            <BarChart/>
                          </div>
                    </div>
                    </div>
                </div>
                <div class="card bg-border-card px-3 py-3">
                  <div class="d-flex justify-content-between card">
                    <h5 class="card-header fw-bold bg-textmain">Recent PurChase</h5>
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
                        <tr v-if="paginatedData.length === 0">
                            <td colspan="8" class="text-center">No Recent Order made </td>
                        </tr>
                        <tr v-for="(item, index) in paginatedData" :key="item.id" >
                          <td >{{ item.username }}</td>
                          <td>{{ item.marketid }}</td>
                          <td>{{ item.price }}</td>
                          <td>{{ item.portion }}</td>
                          <td>{{ item.cartdrink }}</td>
                            <td :class="[item.cartstatus === 'delivered' ? 'text-success' : 'text-danger']">
                              {{ item.cartstatus }}
                            </td>
                          <td>{{ item.created_at }}</td>
                          <td @click="openModal(item)" class="d-flex align-items-center justify-content-center py-4 cursor-pointer">
                            <i class="fa-solid fa-eye"></i>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div v-if="noResults" class="text-center py-4">
                      Mealxpress couldn't find any query data of this such {{ searchQuery }}
                    </div>
                  </div>        
                  <!-- Pagination Controls -->
                  <div class="d-flex justify-content-between mb-2 py-2 px-4">
                    <span class="bg-textmain">Page {{ currentPage }} of {{ totalPages }}</span>
                      <div class="d-flex justify-content-between gap-2">
                      <select v-model="rowsPerPage" @change="changevaluestate" class="form-select w-20">
                        <option v-for="option in dropOption" :key="option" :value="option">
                          {{ option }}
                        </option>
                      </select>
                      <div class="d-flex gap-4">
                        <button @click="prevPage" class="bg-textmain" :disabled="currentPage === 1">Previous</button>
                        <button @click="nextPage" class="bg-textmain" :disabled="currentPage === totalPages">Next</button>
                      </div>
                    </div>
                  </div>
                </div> 
               </div>
           </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import '../../assets/vendor/css/rtl/core.css';
  import '../../assets/vendor/css/rtl/theme-default.css';
  import '../../assets/vendor/fonts/boxicons.css';
  import '../../assets/vendor/fonts/fontawesome.css';
  import '../../assets/mealxpresscustom/app.css';
  import '../../assets/mealxpresscustom/media.css';
  import '../../assets/css/demo.css';

  import NavbarComponent from './../../components/vendorsnav/aside.vue';
  import Navigation from './../../components/vendorsnav/navigation.vue';
  import HeaderDashboard from './../../components/vendorsnav/header.vue';
  import TransferInit from './../../components/modals/transferinit.vue';
  import VisibleCharts from './../../components/modals/showcharts.vue';
  import BarChart from './../../components/charts/chartview.vue';
  import { Link, usePage } from '@inertiajs/vue3';
  import { useToast } from "vue-toastification";
  import {ref, computed,onMounted, watch} from 'vue';
  import { Button } from 'bootstrap';
  
  export default {
    components: {
      NavbarComponent,
      Navigation,
      HeaderDashboard,
      VisibleCharts,
      BarChart,
      Link,
      TransferInit,
    },
   
    methods: {
      formatCurrency(value) {
        return new Intl.NumberFormat('en-NG', { 
          style: 'currency', 
          currency: 'NGN',
          minimumFractionDigits: 2, 
          maximumFractionDigits: 2
        }).format(value);
      },
    },




    setup(){
    const {props} = usePage();
    const searchQuery = ref('');
    const mainbalance = ref(props.accountbalance || []);
    const rowsPerPage = ref(3); // Default rows per page
    const currentPage = ref(1);
    const dropOption = [3, 20, 50, 100];
    const data  = ref(props.data || []);
    const totalsum = ref(props.totalsum || []);
    const salescount = ref(props.salescount || []);
    const populatebanks  =  ref(null);
    const stablevisible = ref(false);
    const isBalanceVisible = ref(false);
    const chartvisible = ref(false);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// algorithms for table contents

    const iconClass = computed(() => {
      return isBalanceVisible.value ? 'fa-eye' : 'fa-eye-slash';
    });

    const toggleVisibility = () => {
      isBalanceVisible.value =! isBalanceVisible.value;
      localStorage.setItem('balanceVisibility', isBalanceVisible.value ?'visible' : 'hidden' );
    }

      // Method to format the currency (example formatting)
      const formatCurrency = (amount) => {
      return new Intl.NumberFormat().format(amount); // Simple number formatting
    };

    // Load visibility state from localStorage when component is mounted
    const loadVisibilityState = () => {
      const savedVisibility = localStorage.getItem('balanceVisibility');
      isBalanceVisible.value = savedVisibility === 'visible';
    };

    // Lifecycle hook: onMounted equivalent in the Composition API
    onMounted(() => {
      loadVisibilityState(); // Check localStorage on mount
    });

    // Watch the mainbalance if it's updated dynamically (optional)
    watch(mainbalance, (newValue) => {
      console.log("Balance updated:", newValue);
    });






   const  fetchallbanks = async () => {
    const response = await axios.get('/vendorspath/populatebanks', {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      }
    });
    try{
    if(response.status){
      populatebanks.value = response.data.data;
       console.log(populatebanks);
    }else{
      console.log(response.status);
    }
    }catch(error){
      console.log(error);
    }

   };

   const showcharts = () => {
    chartvisible.value = true;
        fetchallbanks();
        console.log(stablevisible.value);
     };
    const  dismisscharts = () => {
      chartvisible.value = false;
     };
   

     const showtransfermodel = () => {
        stablevisible.value = true;
        fetchallbanks();
        console.log(stablevisible.value);
     };
    const  dismissmodalclear = () => {
       stablevisible.value = false;
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
    // end of table algorithms
    // return call function
    return {
      searchQuery,
      rowsPerPage,
      currentPage,
      changevaluestate,
      data,
      showcharts,
      dismisscharts,
      chartvisible,
      noResults,
      totalPages,
      paginatedData,
      nextPage,
      dropOption,
      prevPage,
      totalsum,
      salescount,
      stablevisible,
      toggleVisibility,
      showtransfermodel,
      dismissmodalclear,
      populatebanks,
      mainbalance,
      isBalanceVisible,
      iconClass,
      formatCurrency
    }

    }
  };
  </script>
  