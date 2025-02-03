<template>
    <Head>
        <title>Mealxpress | Product Lists</title>
    </Head>
    <div class="main-board-mealxpress">
        <NavbarComponent />
        <div class="mealxpress-content">
          <HeaderDashboard/>
          <div class="mealxpress-mai">
            <div class="card-general-container card p-2">
            <div class="row">
                <div class="col-lg-12">
                <h1 class="fs-3 ms-2 py-2">Payouts</h1>
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
                                    <button @click="downloadPDF" class="togglebutton btn bg-button-submit py-3 text-sm">Download</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive text-nowrap">
                          <table class="table">
                           <thead>
                              <tr>
                              <th>Payout</th>
                              <th>Recipient</th>
                              <th>Amount</th>
                              <th>Settled Amount</th>
                              <th>reference</th>
                              <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>

                            <tr v-if="paginatedData.length === 0">
                                <td colspan="8" class="text-center">
                                 No Payment Returns Available...
                                </td>
                              </tr>

                              <tr v-for="(item, index) in paginatedData" :key="item.id">
                                <td v-if="noResults">No data found  </td>
                                <td>{{item.payout}}</td>
                                <td>{{item.recipient}}</td>
                                <td>₦{{formattedPrice(item.amount)}}</td>
                                <td>{{formattedSettledPrice(item.settleamount)}}</td>
                                 <td>{{item.referencecode}}</td>
                                 <td><span :class="[item.status == 'active' ? 'bg-label-success rounded-lg  p-2' : 'bg-label-info p-2 rounded-lg']">{{item.status}}</span></td>
                       
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
        <div class="col-lg-2 d-none">
            <div class="card py-3"></div>
        </div>
    </div>
            
        
                
            </div>
         </div>
        </div>
    </div>  
  
  </template>
  
  <script>

  import { ref, computed } from 'vue';
  import NavbarComponent from './../../components/vendorsnav/aside.vue';
  import HeaderDashboard from './../../components/vendorsnav/header.vue';
  import Addproducts from './../../components/modals/addproducts.vue';
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
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  import jsPDF from 'jspdf';
  import 'jspdf-autotable';

  
  
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
    Newproducts,
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

    const formattedPrice = (price) => {
    if (price === null || price === undefined) return '';
    return parseFloat(price).toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
  };

  const formattedSettledPrice = (price) => {
    if (price === null || price === undefined) return '';
    return parseFloat(price).toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    });
  };

  const downloadPDF = () => {
  const doc = new jsPDF();

  // Add title
  doc.setFontSize(18);
  doc.text('Mealxpress payout Report', 14, 20);
  // Generate table data
  const tableData = paginatedData.value.map((item) => [
    item.payout,
    item.recipient,
    formattedPrice(item.amount),
    formattedSettledPrice(item.settleamount),
    item.referencecode,
    item.status,
  ]);

  // Generate table headers
  const headers = [['Payout', 'Recipient', 'Amount', 'SettledAmount', 'Reference', 'Status']];
  // Use jsPDF-autotable
  doc.autoTable({
    head: headers,
    body: tableData,
    startY: 30,
    headStyles:{
    fillColor: [255,255,255],
    },
    styles: { fontSize: 8, cellPadding: 4 },
  });

  // Save the PDF
  doc.save('payouts-report.pdf');
};



    // table
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
      searchQuery,
      rowsPerPage,
      nextPage,
      prevPage,
      changevaluestate,
      totalPages,
      noResults,
      paginatedData,
      formattedSettledPrice,
      dropOption,
      formattedPrice,
      
      currentPage,
      data,
      downloadPDF,
    }


  }
}

  
  </script>
  