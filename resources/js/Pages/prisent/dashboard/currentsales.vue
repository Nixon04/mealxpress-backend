<template>
  <div>
    <Head>
        <title>Mealxpress | Current Sales</title>
    </Head>
    <div class="main-board-mealxpress">
        <NavbarComponent />
        <div class="mealxpress-content">
          <HeaderDashboard/>
          <div class="mealxpress-mai">
            <div class="card-general-container card p-2">
                <div class="card">
                    <h5 class="card-header"></h5>
                    <div class="d-flex justify-content-between px-6">
                        <div class="d-flex">
                            <div class="form-input">
                                <input type="text" class="form-control py-2" v-model="searchQuery"  placeholder="Search...">
                            </div>
                        </div>
                        <div class="d-flex gap-4">
                            <div class="form-input">
                                <select v-model="rowsPerPage"  class="form-select py-2" @change="changevaluestate" >
                                    <option v-for="option in dropOption" :key="option" :value="option">{{ option }}</option>
                                </select>
                            </div>
                            <!-- <div class="meal-form-button">
                                <button @click="ShowCenterModel(item)" class="togglebutton btn bg-button-submit py-3 text-sm">Add Category</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-bod">
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                       <thead>
                          <tr>
                          <th>MarketId</th>
                          <th>ProductName</th>
                          <th>Price</th>
                          <th>Portion</th>
                          <th>Total</th>
                          <th>CartImage</th>
                          <th>CartReference</th>
                          <th>User_ID</th>
                          <th>CartRefCode</th>
                          <th>Date</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr v-if="paginatedData.length === 0">
                          <td colspan="8" class="text-center">
                            No Current Sale found yet
                          </td>
                        </tr>
                          <tr v-for="(item, index) in paginatedData" :key="index.id">
                            <td v-if="noResults">No data found  </td>
                            <td>  <span class="fw-medium">{{item.marketid}}</span></td>
                            <td>  <span class="fw-medium">{{item.productname}}</span></td>
                            <td>₦{{formattedPrice(item.price)}}</td>
                            <td>  <span class="fw-medium">{{item.portion}}</span></td>
                            <td>  <span class="fw-medium">₦{{formattedPrice(item.total)}}</span></td>
                            <td> 
                                <img :src="item.cartimage=='' ? 'No Drink Found' : item.cartimage  " alt="image" width="40px" height="40px">
                                <!-- {{ item.cartdrink }} -->
                            </td>
                            <td>  <span class="fw-medium">{{item.cartreference}}</span></td>
                            <td>  <span class="fw-medium">{{item.username}}</span></td>
                            <td>  <span class="fw-medium">{{item.cartrefcode}}</span></td>
                            <td>  <span class="fw-medium">{{item.cartpurchasedate}}</span></td>

                    </tr>
            </tbody>
        </table>
    </div>
    <!-- pagination details -->
    <div class="card p-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <span>Showing {{ currentPage }} to {{ totalPages }} entries</span>
              
            </div>
            <div class="d-flex gap-4">
                <button @click="prevPage" :disabled="currentPage === 1" class="outline-pointer">prev</button>
                <button @click="nextPage" :disabled="currentPage === totalPages" class="outline-pointer">Next</button>
            </div>
        </div>
    </div>
    <!-- end of pagination -->
    </div>
</div>
<!--/ Bordered Table -->

        
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
  import { Link, usePage, Head } from '@inertiajs/vue3';
  import { useToast } from "vue-toastification";
  import {ref, computed} from 'vue';
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
      Head,
    },
    methods: {
    formattedPrice(price) {
      if (price === null || price === undefined) return ''; // Handle null/undefined cases
      return parseFloat(price).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
      });
    },
  },
    setup(){
    const { props } = usePage(); 
    const data = ref(props.data || []);
    const searchQuery = ref('');
    const rowsPerPage = ref(3); // Default rows per page
    const currentPage = ref(1);
    const dropOption = [3, 20, 50, 100];
    const isLoading = ref(false);


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
    const nextPage = () => {
      if (currentPage.value < totalPages.value) currentPage.value++;
    };

    const paginatedData = computed(() => {
      const start = (currentPage.value - 1) * rowsPerPage.value;
      const end = start + rowsPerPage.value;
      return filteredData.value.slice(start, end);
    });

    const prevPage = () => {
      if (currentPage.value > 1) currentPage.value--;
    };

    const changevaluestate = () => {
      currentPage.value = 1;
    };

    const totalPages = computed(() => {
      return Math.ceil(filteredData.value.length / rowsPerPage.value);
    });



    return{
      data,
      searchQuery,
      rowsPerPage,
      nextPage,
      prevPage,
      changevaluestate,
      totalPages,
      noResults,
      paginatedData,
      dropOption,
      currentPage
    }
    }
}
    
    </script>

