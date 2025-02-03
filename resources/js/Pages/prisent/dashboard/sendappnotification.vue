<template>
    <Head>
      <title>Mealxpress | Send Notification</title>
    </Head>
    <div class="main-board-mealxpress">
      <EditVendors/>
        <NavbarComponent />
        <div class="mealxpress-content">
          <HeaderDashboard/>
          <div class="mealxpress-mai">
            <div class="card-general-container card p-1">
                <div class="card mx-3 px-3 p-3">
                    <h5 class="card-header"></h5>
                      <div class="form-input mb-3">
                        <input type="text" class="form-control py-3" placeholder="Title of your message" v-model="statevalue.title">
                      </div>
                      <div class="form-input mb-3">
                        <textarea class="form-control" v-model="statevalue.message" rows="10"></textarea>
                      </div> 
                      <div class="form-input">
                          <button @click="sendnotification" :class="[ isLoading ? 'cursor-not-allowed bg-button-submit' : 'bg-button-submit']">
                           {{ isLoading ? 'loading...' :  'Send to Users' }}
                          </button>
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
  import { Link, usePage,Head } from '@inertiajs/vue3';
  import { useToast } from "vue-toastification";
  import {ref, computed, reactive} from 'vue';
  import axios from 'axios';
  import { Inertia } from '@inertiajs/inertia';
  import  EditVendors  from './../../components/modals/Edits/editvendors.vue';
  import Addproducts from './../../components/modals/adminmodals/addvendors.vue';
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  
  
  export default {
    components: {
      NavbarComponent,
      Navigation,
      HeaderDashboard,
      BarChart,
      Link,
      TransferInit,
      Addproducts,
      Head,
      EditVendors,
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
  
   
    const statevalue = reactive({
      'title': '',
      'message': '',
    });

    
  
    const delay = (ms) =>  new Promise(resolve => setTimeout(resolve, ms));
    const addVisible = ref(false);
   
    const sendnotification = async () => {
  
      if(isLoading.value) return;
      const toast = useToast();
      const payload = {
        title: statevalue.title,
        message: statevalue.message,
      }
      if(!statevalue.title  || !statevalue.message ){
      const toast = useToast();
      toast.info('Information needed',{
        hideProgressBar:true,
        timeout:3000,
      });
    }
      try{
        isLoading.value = true;
    const response = await axios.post('/prisent/dashboard/sendnotification',payload,{
      'Content-Type':'application/json',
    });

    if(response.status == 200){
      const toast = useToast();
     if(response.data.status == "success"){
      toast.success(response.data.message,{
        hideProgressBar:true,
        timeout:3000,
      });
     }else{
      toast.error(response.data.message,{
        hideProgressBar:true,
        timeout:3000,
      });
     }
      console.log(response.status);
    }else{
      console.log(response.status);
    }
   } 
  catch(error){
      console.log(error);
    }
    finally{
      isLoading.value = false;
    }
    
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
      try{
      isOptionLoading.value = true;
      await delay(3000);
      const response = await axios.post('/prisent/dashboard/addvendors', data,{
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
      sendnotification,
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
      addVisible,
      statevalue,
      isLoading,
      isOptionLoading,
    }
    }
  }
    
    </script>
  
  