<template>
  <div>
    <Head>
      <title>Mealxpress | Vendors Information and Registration</title>
    </Head>
    <div class="main-board-mealxpress">
        <DeleteModel :deleteVisible="deleteVisible" :deleteloading="deleteloading" :identifier="identifier" @close="deleteclear" @deletesubmit="deleteproductbutton"/>  
      <AddCategory :addVisible="addVisible" @close="CloseCenterModel" @submitmodal="submitmodal"  :isOptionLoading="isOptionLoading" />
      <EditVendors/>
        <NavbarComponent />
        <div class="mealxpress-content">
          <HeaderDashboard />


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
                                <button @click="ShowCenterModel(item)" class="togglebutton btn bg-button-submit py-3 text-sm">Add Category</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                       <thead>
                          <tr>
                          <th>Category Name</th>
                          <th>Category Item</th>
                          <th>Status</th>
                          <th>Action </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-if="paginatedData.length == 0" class="text-center">
                            <td colspan="9">No Registered Category Found</td>
                          </tr>
                          <tr v-for="(item, index) in paginatedData" :key="index.id">
                            <td v-if="noResults">No data found  </td>
                            <td>  <span class="fw-medium">{{item.categoryname}}</span></td>
                            <td>  <span class="fw-medium">{{item.categoryitem}}</span></td>
                            <td>  <span class="fw-medium">{{item.status}}</span></td>
                            <td>
                              <a @click="DeleteModalButton(item)" class="cursor-pointer"><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
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
  import { Link, usePage,Head } from '@inertiajs/vue3';
  import { useToast } from "vue-toastification";
  import {ref, computed} from 'vue';
  import axios from 'axios';
  import { Inertia } from '@inertiajs/inertia';
  import  EditVendors  from './../../components/modals/Edits/editvendors.vue';
  import AddCategory from './../../components/modals/adminmodals/addCategory.vue';
  import DeleteModel from './../../components/modals/adminmodals/deletecategory.vue';
  
  
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  
  export default {
    components: {
      NavbarComponent,
      Navigation,
      HeaderDashboard,
      BarChart,
      Link,
      TransferInit,
      AddCategory,
      Head,
      EditVendors,
      DeleteModel,
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
    const rowsPerPage = ref(5); // Default rows per page
    const currentPage = ref(1);
    const dropOption = [5, 20, 50, 100];
    const isLoading = ref(false);
    const isOptionLoading = ref(false); 
    const deleteVisible = ref(false);
    const deleteloading = ref(false);
    const imageref = ref(props.image || []);

    console.log('console reg', imageref);

    const identifier = ref({
      targetitem : '',
    });

    const deleteproductbutton = async () => {
  const payload = {
    deleteid: identifier.value.targetitem,
  };
  deleteloading.value = true; 
  await delay(1000);
  try {
    const response = await axios.post('/prisent/dashboard/deletecat', payload, {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      },
    });
    if (response.status === 200) {
      Inertia.reload();
      if(response.statuscall  == "sucess"){
        const toast = useToast();
        toast.success("Deleted successful", {
        timeout: 2000,
        hideProgressBar:true,
        });
      }else{
        console.log('Not successful');
      }
    } else {
      console.log('Error: ', response.status);
    }
  } catch (error) {
    console.log('Error: ', error);
  } finally {
    deleteloading.value = false;
  }
};
  
    const delay = (ms) =>  new Promise(resolve => setTimeout(resolve, ms));
    const addVisible = ref(false);
    const ShowCenterModel = (item) => {
        console.log('Toggle inserted');
        addVisible.value = true;
      };
  
      const CloseCenterModel = () => {
        addVisible.value = false;
      }
    const DeleteModalButton = async (item) => {
     deleteVisible.value = true;
     identifier.value.targetitem = item.id;
     console.log('Deleteditem', identifier.value.targetitem);
    };

    const deleteclear = (item) => {
      deleteVisible.value = false;
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
  
  
    const submitmodal = async (data) => {
      if(isOptionLoading.value){
        return;
      }
      try{
      isOptionLoading.value = true;
      await delay(1000);
      const response = await axios.post('/prisent/dashboard/addcategory', data,{
        headers: {
            'X-CSRF-TOKEN': csrfToken,
          },
      });
    if(response.status == 200){
      const toast = useToast();
     if(response.data.status  == "success"){
      toast.success(response.data.message, {
        hideProgressBar:true,
        timeout: 3000,
      });
      Inertia.reload({
        only: ['data'],
      });
  
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
      console.log(error);
    }
    finally{
      isOptionLoading.value = false;
    }
  }
  
  
    return{
      submitmodal,
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
      ShowCenterModel,
      addVisible,
      CloseCenterModel,
      DeleteModalButton,
      isOptionLoading,
      deleteVisible,
      deleteproductbutton,
      identifier,
      deleteclear,
      deleteloading,
      imageref,
    }
    }
  }
    
    </script>
  
  