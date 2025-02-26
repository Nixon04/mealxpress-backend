<template>
    <div class="main-board-mealxpress">
      <NavbarComponent />
      <div class="mealxpress-content">
        <HeaderDashboard/>
        <div class="mealxpress-main me-2 ms-2">
           <div class="row">
            <div class="col-lg-12 ">
              <div class="col-lg-12 col-12 mb-5">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex flex-column">
                    <h1 class="fs-2 fw-bold bg-textmain bg-f-1">Dashboard</h1>
                     <h6 class="mb-5">Here's your dashboard sales details overview</h6>
                     <div class="d-flex flex-column">
                      <h6 class="mb-1 fw-bold bg-textmain">Current Earning 🚀</h6>
                    </div>


                    <div class="d-flex gap-3 align-items-center">
                      <span v-if="!isBalanceVisible" class="bg-f-2 fw-bold bg-textmain">₦*********</span>
                        <h1 v-show="isBalanceVisible" class="bg-f-2 fw-bold bg-textmain">{{formatCurrency(ordersum)}}</h1>
                        <i @click="toggleVisibility"  :class="['fas', 'fs-4', 'cursor-pointer', 'bg-textmain', iconClass]"></i>
                      </div>
                   </div>
                  <div class="d-flex">
                    <Button  @click="showtransfermodel" class="bg-button-submit btn p-3 m-3 py-2 ">
                      BlackList 
                    </Button>
                  </div> 
                </div>
              </div>
                <div class="row mb-3">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-6 col-12 ">
                                <div class="card  gap-1 shadow-none card-outline mb-3">
                                   <div class="d-flex justify-content-between mb-2 px-5 p-2">
                                    <h1 class="fs-1 fw-bold bg-textmain py-1">Total Sales</h1>
                                      <div class="bg-circle border-circle">
                                        <i class="fa-solid fa-ellipsis"></i>
                                      </div>
                                   </div>
                                   <div class="div-centered mb-3 px-5 p-2">
                                    <h1 class="fs-2 fw-bold mb-3 bg-textmain ">{{formatCurrency(totalsum)}}</h1>
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
                                        <h6 class="bg-textmain">View More</h6>
                                        <div class="bg-circle">
                                          <i class="fa-solid fa-chevron-right bg-textmain"></i>
                                        </div>
                                      </div>
                                     </div>
                                   </Link>
                                </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="card  gap-1 shadow-none card-outline mb-3">
                                 <div class="d-flex justify-content-between mb-2 px-5 p-2">
                                  <h1 class="fs-1 fw-bold bg-textmain py-1">Total Orders</h1>
                                    <div class="bg-circle border-circle">
                                      <i class="fa-solid fa-ellipsis"></i>
                                    </div>
                                 </div>
                                 <div class="div-centered mb-3 px-5 p-2">
                                  <h1 class="fs-2 fw-bold mb-3 bg-textmain"> {{formattedNumber(totalcount)}}</h1>
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
                              <div class="card p-4">
                                <div class="d-flex justify-content-between">
                                  <h1 class="fs-2 fw-bold bg-textmain">Customer Activities</h1>
                                  <h6 class="fw-bold fs-4">+239</h6>
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
  import '../../assets/vendor/fonts/flag-icons.css';
  import '../../assets/mealxpresscustom/app.css';
  import '../../assets/mealxpresscustom/media.css';
  import '../../assets/css/demo.css';

  import NavbarComponent from './../../components/adminnav/aside.vue';
  import Navigation from './../../components/vendorsnav/navigation.vue';
  import HeaderDashboard from './../../components/adminnav/headers.vue';
  import TransferInit from './../../components/modals/transferinit.vue';
  import BarChart from './../../components/charts/chartview.vue';
  import { Link, usePage } from '@inertiajs/vue3';
  import { useToast } from "vue-toastification";
  import {ref, computed,onMounted, watch} from 'vue';
  import { Button } from 'bootstrap';
  import axios from 'axios';
  
  export default {
    components: {
      NavbarComponent,
      Navigation,
      HeaderDashboard,
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

      formattedNumber(value) {
        return new Intl.NumberFormat('en-US', { 
          minimumFractionDigits: 2, 
          maximumFractionDigits: 2
        }).format(value);
      }
    },
    setup(){
    const {props} = usePage();
    const searchQuery = ref('');
    const rowsPerPage = ref(3); // Default rows per page
    const currentPage = ref(1);
    const dropOption = [3, 20, 50, 100];
    const data  = ref(props.data || []);
    const totalsum = ref(props.totalsum || []);
    const totalcount = ref(props.totalcount || []);
    const ordersum = ref(props.ordersum || []);
    const salescount = ref(props.salescount || []);
    const populatebanks  =  ref(null);
    const stablevisible = ref(false);
    const isBalanceVisible = ref(false); 
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
// algorithms for table contents

const iconClass = computed(() => {
      return isBalanceVisible.value ? 'fa-eye' : 'fa-eye-slash';
    });


     const toggleVisibility = () => {
      isBalanceVisible.value =! isBalanceVisible.value;
      localStorage.setItem('balanceVisibility', isBalanceVisible.value ?'visible' : 'hidden' );
    }

  
    // Load visibility state from localStorage when component is mounted
    const loadVisibilityState = () => {
      const savedVisibility = localStorage.getItem('balanceVisibility');
      isBalanceVisible.value = savedVisibility === 'visible';
    };

    // Lifecycle hook: onMounted equivalent in the Composition API
    onMounted(() => {
      loadVisibilityState(); // Check localStorage on mount
    });

    // Watch the mainbalance if it's updated periodically, highly customizable and its quite optional
    watch(ordersum, (newValue) => {
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
      totalsum,
      totalcount,
      ordersum,
      searchQuery,
      iconClass,
      isBalanceVisible,
      rowsPerPage,
      currentPage,
      toggleVisibility,
      changevaluestate,
      data,
      noResults,
      totalPages,
      paginatedData,
      nextPage,
      dropOption,
      prevPage,
      totalsum,
      salescount,
      stablevisible,
      showtransfermodel,
      dismissmodalclear,
      populatebanks,
    }

    }
  };
  </script>
  