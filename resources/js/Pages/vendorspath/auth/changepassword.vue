
<!--  -->
<template>
    <div>
      <!-- header -->
      <Head>
        <title>Mealxpress | Change Password Page</title>
      </Head>
      <div class="mealxpress-background-set">
          <div class="meal-header-state bg-pad-big">
            <h1 class="text-white bg-center-text fw-bold fs-2">Mealxpress<span class="bg-color-secondary">.ng</span></h1>
          </div>
          <div class="login-container-set">
           <div class="login-spacing mb-5">
              <h1 class="bg-center-text fs-3 fw-bold bg-color-primary mb-2">Change Password</h1>
              <h6 class="bg-center-text bg-color-primary">Hurray, finally we are here, Configure your password to your taste, wish you the best.</h6>
           </div>     
           <div class="form-data-set">
            <form @submit.prevent="ConfirmToken">
                <div class="form-inputs mb-5 position-relative">
                    <input :type="passwordfield" id="password" v-model="password" class="py-3 form-control" placeholder="Enter Password" autofocus>
                    <span class="pass-top" @click.prevent="toggleVisibility">
                      <i :class="showPassword? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                    </span>
                   <span></span>
                  </div>
           
            <div class="form-inputs mb-3">
              <button type="submit" :class="loading ? 'mealxpress-main-button btn' : 'btn mealxpress-main-button' ">
                {{ loading ? 'Loading...' : 'Recover' }}
              </button>
            </div>
            </form> 
          </div>
        </div>
        <div class="forgot-position">
    
       <Link href="./login">
         <h1 class="text-white bg-center-text fw-bold fs-7">Not Interest? 
          <span class="bg-color-secondary ms-2">Go back to Login</span>
        </h1>
      </Link>
        </div> 
      </div>
    </div>
  </template>
  <script>
  
  import axios from 'axios';
  import '../../assets/vendor/css/rtl/core.css';
  import '../../assets/vendor/css/rtl/theme-default.css';
  import '../../assets/vendor/fonts/boxicons.css';
  import '../../assets/vendor/fonts/fontawesome.css';
  import '../../assets/vendor/fonts/flag-icons.css';
  import '../../assets/mealxpresscustom/app.css';
  import '../../assets/mealxpresscustom/media.css';
  import { Head } from '@inertiajs/inertia-vue3';
  import {Link} from '@inertiajs/inertia-vue3';
  import { useToast } from 'vue-toastification';
  
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  
  export default{

    data() {
      return {
       token:'',
       password: '',  
       showPassword: false,   
        errorMessage: '',
        loading: false,
      };
    },
    components:{
      Link,
      Head,
    },
    computed:{
      passwordfield(){
        return this.showPassword ? 'text' : 'password';
      },
    },
  methods:{
    toggleVisibility(){
    this.showPassword =! this.showPassword;
  },

    async ConfirmToken(){
      if (this.loading) return;
      const toast = useToast();
      if(!this.password){
        toast.info("Please input your preferred password", {
          timeout: 2000,
          hideProgressBar:true,
          icon: false,
        });
        return;
      }

      const payload = {
        password: this.password,
      }
      try{
        this.loading = true;
        const response = await axios.post('/vendorspath/vendorschangepassword', payload, {
          method: 'POST',
          headers: {'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          }, 
        });
        if(response.data.status == "success"){
         toast.success(response.data.message,{
          timeout:3000,
          hideProgressBar: true,
          icon:false,
         });
         window.location.href = 'login';
        }else{
          toast.error(response.data.message,{
          timeout:3000,
          hideProgressBar:true,
          icon:false,
         });
        }
      
      }finally{
        this.loading = false;
      }
    }
  },
  };
  
  </script>
  
  