<template>
    <div v-if="chartvisible" class="transfercontainer">
        <div class="bg-transfer-padding-all w-60">
            <div class="d-flex justify-content-end">
                <div class="bg-circle" @click="dismisscharts">
                    <div class="fas fa-x fas-sm"></div>
                </div>
            </div>
            <div class="headers">
                <h1 class="bg-mealcolor fs-4 d-flex align-items-center justify-content-center text-center mb-4 fw-bold">MealXpress</h1>
               <span class="d-flex justify-content-center bg-textmain mb-4">Current Charts sales</span>
            </div>

            <div class="content-transfer-body">
                <div class="col-lg-12 col-md-12 ">
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
                                <h1 class="fs-4 fw-bold mb-5 bg-textmain">₦{{ formatCurrency(totalsum) }} </h1>
                              
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
                              <h1 class="fs-4 fw-bold mb-5 bg-textmain"> {{formatCurrency(salescount)}}</h1>
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
                            <div class="d-flex justify-content-between align-items-center">
                              <h1 class="fs-2 fw-bold bg-textmain">Customer Activities</h1>
                              <h6 class="bg-textmain">Active</h6>
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
  import { Link, usePage } from '@inertiajs/vue3';  
export default{    
    props:{
        chartvisible:{
            type: Boolean,
            required: true,
        },
        salescount:{
            type:Array,
            required:true,
        },
        totalsum:{
            type:Array,
            required:true,
        }
    },
    methods:{
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
        dismisscharts(){
            this.$emit('close');
        }
    },
    setup(){
        const formatCurrency = (amount) => {
      return new Intl.NumberFormat().format(amount); // Simple number formatting
    };
return{
    formatCurrency,
}
    }
}
</script>
