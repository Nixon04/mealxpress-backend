
<!--  -->
<template>
    <div>
      <!-- header -->
      <Head>
        <title>Mealxpress | Forgot Page</title>
      </Head>
      <div class="mealxpress-background-set">
          <div class="meal-header-state bg-pad-big">
            <h1 class="text-white bg-center-text fw-bold fs-2">Mealxpress<span class="bg-color-secondary">.ng</span></h1>
          </div>
          <div class="login-container-set">
           <div class="login-spacing mb-5">
              <h1 class="bg-center-text fs-3 fw-bold bg-color-primary mb-2">Forgot your account</h1>
              <h6 class="bg-center-text bg-color-primary">Enter your verified email address to get your token</h6>
           </div>     
           <div class="form-data-set">
            <form @submit.prevent="ForgotSubmit">
             <div class="form-inputs mb-3">
              <input type="text" class="py-3 form-control" v-model="emailID" placeholder="Enter your email" autofocus>
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
  import {InertiaLink} from '@inertiajs/inertia-vue3';
  
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  export default{
  
    setup(){
    const toast = useToast();
    },
    data() {
      return {
       emailID:'',
        errorMessage: '',
        loading: false,
      };
    },
    components:{
      Link,
      Head,
      InertiaLink,
    },
    computed:{
      passwordfield(){
        return this.showPassword ? 'text' : 'password';
      },
    },
  methods:{
    async ForgotSubmit(){
      if (this.loading) return;
      const toast = useToast();
      if(!this.emailID){
        toast.info("Please input email", {
          timeout: 2000,
          hideProgressBar:true,
          icon: false,
        });
        return;
      }
        // Regular expression to validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.emailID)) {
        toast.error("Please enter a valid email address", {
            timeout: 2000,
            hideProgressBar: true,
            icon: false,
        });
        return;
        }

      const payload = {
        email: this.emailID,
      }
      try{
        this.loading = true;
        await this.delay(2000);
        const response = await axios.post('/vendorspath/vendorslogin', payload, {
          method: 'POST',
          headers: {'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          }, 
        });
        if(response.data.status == "success"){
         toast.success('Login successfully',{
          timeout:3000,
          hideProgressBar: true,
          icon:false,
         });
         window.location.href = '../dashboard/home';
        }else{
          toast.error("Email or password not correct",{
          timeout:3000,
          hideProgressBar:true,
          icon:false,
         });
        }
      }catch(error){
        toast.error(`Oops something went wrong try again later ${error}`,{
          timeout:3000,
          hideProgressBar: true,
          icon:false,
         });
      }finally{
        this.loading = false;
      }
    }
  },
  };
  
  
  </script>
  
  