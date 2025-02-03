<template>
  <Head>
    <title>Mealxpress | Drivers Information and Registration</title>
  </Head>
  <div class="main-board-mealxpress">
    <Addproducts :addVisible="addVisible" @close="CloseCenterModel" @submitmodal="SubmitFunction" />
    <EditDriversComponent :showEditValue="showEditValue" @close="CloseEditModal" :dataHolder="dataHolder" :editsubmit="updateDrivers"/>
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
                          <div class="meal-form-button">
                              <button @click="ShowCenterModel(item)" class="togglebutton btn bg-button-submit py-3 text-sm">Add Drivers</button>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                     <thead>
                        <tr>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>NextOfKin</th>
                        <th>KinContact</th>
                        <th>TrackerId</th>
                        <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in paginatedData" :key="item.id">
                          <td v-if="noResults">No data found  </td>
                          <td>  <span class="fw-medium">{{item.firstname}}</span></td>
                          <td>{{item.lastname}}</td>
                          <td>{{item.email}}</td>
                          <td>{{item.contact}}</td>
                          <td>{{item.nextofkin}}</td>
                          <td>{{item.kincontact}}</td>
                          <td>{{item.trackerid}}</td>
                          <td @click="editdrivers(item)"><i class="fa-solid fa-ellipsis cursor-pointer"></i></td>
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
import { Link, usePage,Head } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";
import { Inertia } from '@inertiajs/inertia';
import {ref, computed} from 'vue';
import { Button } from 'bootstrap';
import axios from 'axios';
import Addproducts from './../../components/modals/adminmodals/addDrivers.vue';
import EditDriversComponent from  './../../components/modals/Edits/editdrivers.vue';


export default {
  components: {
    EditDriversComponent,
    NavbarComponent,
    Navigation,
    HeaderDashboard,
    BarChart,
    Link,
    TransferInit,
    Head,
    Addproducts,
  },
  setup(){
  const { props } = usePage(); 
  const data = ref(props.data || []);
  const searchQuery = ref('');
  const rowsPerPage = ref(5); // Default rows per page
  const currentPage = ref(1);
  const dropOption = [5, 20, 50, 100];
  const isLoading = ref(false);
  const addVisible = ref(false);
  const showEditValue = ref(false);
  const dataHolder =  ref('');


  const updateDrivers = (item) => {
  const response = axios.post('', item,{
    'Content-Type': 'application/json',
  })
  };


  const editdrivers = async (item) => {
    showEditValue.value = true;
    dataHolder.value = item;
    console.log(dataHolder);
  };

  const CloseEditModal = () => {
    showEditValue.value = false;
  };

  const SubmitFunction = async (item)  => {
    const toast = useToast();
     try{
    const response = await axios.post('/prisent/dashboard/postdrivers', item,{
      'Content-Type': 'application/json',
    });
    if(response.status == 200){
    const toast = useToast();
   if(response.data.status  == "success"){
    toast.success(response.data.message, {
      hideProgressBar:true,
      timeout: 3000,
    });
    Inertia.reload('');

    setTimeout(() => {
     CloseCenterModel();
    }, 3000);
   }
   else{
    toast.info(response.data.message, {
      hideProgressBar:true,
      timeout: 3000,
    });
   }
  }
  else{
    toast.info('Oops seems something went wrong', {
      hideProgressBar:true,
      timeout: 3000,
    });
    console.log('checker ');
   }

  }catch(error){
    console.log('Error Track', error);
  }
  };


  const ShowCenterModel = (item) => {
      console.log('Toggle inserted');
      addVisible.value = true;
    };

    const CloseCenterModel = () => {
      addVisible.value = false;
    }

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
    showEditValue,
    editdrivers,
    CloseEditModal,
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
    currentPage,
    Addproducts,
    ShowCenterModel,
    CloseCenterModel,
    addVisible,
    SubmitFunction,
    dataHolder,
    updateDrivers,
  }
  }
}
  
  </script>

