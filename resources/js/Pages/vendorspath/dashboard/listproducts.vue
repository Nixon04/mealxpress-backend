<template>
  <div>
    <Head>
        <title>Mealxpress | Product Lists</title>
    </Head> 

    <div class="main-board-mealxpress">
     <Newproducts :isVisible="isVisible"   @close="disclosemodel" :ModalData="ModalData" @submit="updateproducts" @file-change="handleFileChange" :isLoadingUpdate="isLoadingUpdate"/>
     <Addproducts :addVisible="addVisible" :isLoadingProduct="isLoadingProduct" :isLoadingUpdate="isLoadingUpdate" :cat="cat" @close="CloseCenterModel"  @submitmodal="UploadProducts"/>
      <DeleteModel :deleteVisible="deleteVisible" :deleteloading="deleteloading" :identifier="identifier" @close="deleteclear" @deletesubmit="deleteproductbutton"/>  
      <NavbarComponent/>
        <div class="mealxpress-content">
          <HeaderDashboard :userid="userid" :imageref="imageref"/>
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
                                        <button @click="ShowCenterModel(item)" class="togglebutton btn bg-button-submit py-3 text-sm">Add Product</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive text-nowrap">
                              <table class="table">
                               <thead>
                                  <tr>
                                  <th>Project</th>
                                  <th>Price</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr v-if="paginatedData.length  === 0" class="text-center">
                                  <td colspan="4">No Product Added</td>
                                </tr>
                                  <tr v-for="(item, index) in paginatedData" :key="index.id">
                                  
                                    <td v-if="noResults">No data found  </td>
                                    <td> <img :src="item.marketimage" alt="" srcset="" class="image-format-small"> <span class="fw-medium">{{item.marketproductname}}</span></td>
                                    <td>₦{{formattedPrice(item.marketproductprice)}}</td>
                                    <td><span class="badge bg-label-info me-1">{{item.marketproductrequired}}</span></td>
                                    <td>
                                  <div class="dropdown d-flex">
                                    <div class="state me-4 cursor-pointer" @click="showmodel(item)">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>

                                    <div class="state me-4 cursor-pointer" @click="DeleteModalButton(item)">
                                      <i class="fa-solid fa-trash" ></i>
                                  </div>
                                </div>
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

<script  >
  import { useToast } from 'vue-toastification';
  import {Inertia} from '@inertiajs/inertia';
  import { ref, computed } from 'vue';
  import NavbarComponent from './../../components/vendorsnav/aside.vue';
  import HeaderDashboard from './../../components/vendorsnav/header.vue';
  import Addproducts from './../../components/modals/addproducts.vue';
  import DeleteModel from './../../components/modals/deleteproduct.vue';
  import '../../assets/vendor/css/rtl/core.css';
  import '../../assets/vendor/css/rtl/theme-default.css';
  import '../../assets/vendor/fonts/boxicons.css';
  import '../../assets/vendor/fonts/fontawesome.css';
  import '../../assets/vendor/fonts/flag-icons.css';
  import './../../assets/mealxpresscustom/app.css';
  import './../../assets/mealxpresscustom/media.css';
  import './../../assets/vendor/js/bootstrap.js';
  import { Head } from '@inertiajs/vue3'; 
  import { usePage } from '@inertiajs/vue3';
  import Newproducts from './../../components/modals/newproducts.vue';
  import axios from 'axios';

export default {
  props: {
    filtercategory:{
      type:Array,
      required:false,
    },
    userid: {
      type: String,
      required: false,
    },
  
  },
  components: {
    NavbarComponent,
    HeaderDashboard,
    Head,
    DeleteModel,
    Newproducts,
    Addproducts,
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

  setup() {
    const { props } = usePage();  
    const data = ref(props.data || []);    
    const cat = ref(props.cat || []);
    const searchQuery = ref('');
    const rowsPerPage = ref(5); // Default rows per page
    const currentPage = ref(1);
    const dropOption = [5, 20, 50, 100];
    const isLoading = ref(false);
    const RData = ref(null);
    const isVisible = ref(false);
    const value3 = ref(null);
    const selectedFile = ref(null);
    const isLoadingUpdate = ref(false);
    const addVisible = ref(false);
    const isLoadingProduct = ref(false);
    const deleteVisible = ref(false);
    const deleteloading = ref(false);
    const imageref = ref(props.image || []);
    const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


    const identifier = ref({
      targetitem : '',
    });
    
  const deleteproductbutton = async () => {
  const payload = {
    deleteid: identifier.value.targetitem,
  };
  deleteloading.value = true; 
  try {
    const response = await axios.post('/vendorspath/deleteproduct', payload, {
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


  
    console.log('filtercategory', cat.value);
    const UploadProducts = async (data) => {
      if(isLoadingProduct.value){
        return;
      }
      setTimeout(() => {
        isLoadingProduct.value = true;
      }, 4000);

      const response = await axios.post('/vendorspath/postproducts', data, {
      headers: {
        'X-CSRF-TOKEN': csrfToken,
      },
      });

       try{
       isLoadingProduct.value = true;
      if(response.status == 200){
         const toast  = useToast();
        toast.success("Uploaded successfully", {
        timeout: 2000,
        hideProgressBar:true,
      });

      setTimeout(() => {
         disclosemodel();
         Inertia.reload(); 
      }, 2000);

      return;
      }else{
        console.log(response.status);
      }
    }catch(error){
      console.log('Error Log form',error);
    }finally{
      isLoadingProduct.value = false;
    }
    };
    const ShowCenterModel = (item) => {
      console.log('Toggle inserted');
      addVisible.value = true;
    };

    const CloseCenterModel = () => {
      addVisible.value = false;
    }
    const handleFileChange = (file) => {
    selectedFile.value = file; // Store the file in `selectedFile`
    console.log('Selected file:', file);
  };

    // Update Product method
    const updateproducts = async (data) => {
      const toast = useToast();

      if(! ModalData.value.productName.trim() || !ModalData.value.productPrice.trim() || !ModalData.value.productWeight.trim()){
        toast.info("Empty field detected", {
        timeout: 2000,
        hideProgressBar:true,
        icon: false,
      });
        return null;
      }

      const formData = new FormData();

      formData.append('ProductName', data.productName );
      formData.append('ProductPrice', data.productPrice);
      formData.append('ProductWeight', data.productWeight);
      formData.append('ProductID', data.productID);

      if (selectedFile.value) {
        formData.append('ProductImage', selectedFile.value);
      }

      try {
        isLoadingUpdate.value = true;
        const response = await axios.post('/vendorspath/updateproductlist', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

     if(response.status  == 200){
      toast.success("Updated successfully", {
        timeout: 2000,
        hideProgressBar:true,
      }),
      setTimeout(() => {
        disclosemodel();
      Inertia.reload();
      }, 2000);
      console.log('Product updated successfully:', response.data);
     }else{
      console.log(response.status);
     }
      } catch (error) {
        console.error('Error updating product:', error);
      }finally{
        isLoadingUpdate.value = false;
      }
    };

    const ModalData = ref({
      productID: '',
      productName: '',
      productPrice: '',
      productWeight: '',
    });

    const showmodel = async (item) => {
      fetchCurrentProduct(item);
      isVisible.value = true;
    };

    const DeleteModalButton = async (item) => {
     deleteVisible.value = true;
     identifier.value.targetitem = item.id;
     console.log('Deleteditem', identifier.value.targetitem);
    };
    

    const deleteclear = (item) => {
      deleteVisible.value = false;
    };

    // delete product

    const deleteproduct = async(item) => {

    const deletepayload = {
      deleteid : item.id,
    };

    console.log('Info loading');

    const response = await axios.post('/vendorspath/deleteproduct', deletepayload, {
    headers: {
      'X-CSRF-TOKEN': csrfToken,
    },
    });

    try{
      deleteloading.value = true;

    }catch(error){
      console.log(error);
    }finally{
      deleteloading.value = false;
    }
  };
  
    const fetchCurrentProduct = async (item) => {
      const payload = {
        uniqueid: item.marketproductid,
      };
      try {
        isLoading.value = true;
        const response = await axios.post('/vendorspath/updateproducts', payload, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
          },
        });
        if (response.status === 200) {
          RData.value = response.data.data;
          ModalData.value.productID = RData.value.marketproductid || '';
          ModalData.value.productName = RData.value.marketproductname || '';
          ModalData.value.productPrice = RData.value.marketproductprice || '';
          ModalData.value.productWeight = RData.value.marketproductweight || '';
          console.log('Success ', ModalData.value);
        } else {
          console.log(response.status);
        }
      } catch (e) {
        console.log(e);
      } finally {
        isLoading.value = false;
      }
    };

    const disclosemodel = () => {
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


    

    return {
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
      showmodel,
      disclosemodel,
      isVisible,
      currentPage,
      ModalData,
      value3,
      selectedFile,
      updateproducts,
      handleFileChange,
      isLoadingUpdate,
      Addproducts,
      addVisible,
      ShowCenterModel,
      CloseCenterModel,
      UploadProducts,
      cat,
      DeleteModalButton,
      deleteVisible,
      isLoadingProduct,
      deleteclear,
      deleteproduct,
      deleteproductbutton,
      identifier,
      deleteloading,
      imageref,
    };
  },
};
</script>
