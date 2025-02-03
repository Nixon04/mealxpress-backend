<template>
    <div class="main-board-mealxpress">
        <NavbarComponent />
        <div class="mealxpress-content">
          <HeaderDashboard/>
          <div class="mealxpress-mai p-1 m-0">
            <!-- {{ data == "" ? 'empty' : data }} -->
            <Tabs value="0" class="custom-tab-class p-1 m-0" scrollable >
              <TabList>
                  <Tab value="0">
                    Store Details
                  </Tab>

                  <Tab value="3">
                      Password
                  </Tab>
                 
              </TabList>
              <TabPanels>
                 <TabPanel value="0">
                  <div class="row">
                    <div class="col-lg-5">
                    <div class="mb-3 image-set-container 
                    card d-flex justify-content-center align-items-center p-4"
                    >
                    <div class="position-relative">
                      <div class=" mb-4 image-set-circle" :style="{backgroundImage: 'url('+ data.marketstoreprofile +')'}" style="background-size:cover; background-position: center; background-repeat: no-repeat;">
                      </div>
                      <label for="infoprofile" class="position-absolute bottom-4 right-3">
                          <div class="text-white bg-bg_main_color cursor-pointer p-4 d-flex justify-content-center align-items-center"
                          style="border-radius: 50%;">
                            <i class="bx bx-camera"></i>
                          </div>
                      </label>
                     </div>                   
                      <input type="file" id="infoprofile" @change="uploadprofile" class="d-none">
                    </div>


                    <div class="card p-5 px-1 bg-label-success">
                        <div class="d-flex justify-content-center">
                          <h1 class="fs-1 text-center fw-bold bg-textmain"> 🚀 You are currently on as a {{data.marketstorecollection}} Representator</h1>
                        </div>
                    </div>
                  </div>

                  <div class="col-lg-7">
                    <div class="card p-3 mb-2">
                      <div class="card-header px-1 py-1">
                        <h1 class="mb-3 fw-bold">Store Details</h1>
                      </div>
                      <div class="card-contents">
                      <div class="row">
                        <div class="col-12 col-lg-6 col-md-6 mb-3">
                          <label for="marketname">Store Name</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.marketstorename"  placeholder="MarketName" >
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 mb-3">
                          <label for="marketname">Contact</label>
                          <div class="form-input">
                          <input type="text" v-model="data.contact" class="form-control py-3" placeholder="Contact">
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 mb-3">
                          <label for="marketname">Email Address</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.email_address" placeholder="Email">
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 mb-2">
                          <label for="marketname">Sender Email</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.sendermail" placeholder="Sender Email">
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                    

                    <div class="card p-3 mb-3">
                      <label for="">Working Hours</label>
                      <select class="form-select py-2" id="" v-model="data.activehours">
                        <option :value="data.activehours">{{  data.activehours}}</option>
                      </select>
                    </div>

                    <div class="card p-3">
                      <div class="card-header px-1 py-1">
                        <h1 class="mb-3">Business Details</h1>
                      </div>
                      <div class="card-contents">
                      <div class="row">
                        <div class="col-12 col-lg-6 col-md-6 mb-3">
                          <label for="marketname">Business Name</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.legalbusiness" placeholder="Business Name">
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 mb-3">
                          <label for="marketname">Residing City</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.city" placeholder="City">
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 mb-3">
                            <label for="marketname">Location (LandMark)</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.marketstoreaddress"  placeholder="Address">
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 mb-2">
                          <label for="marketname">State</label>
                          <div class="form-input">
                          <input type="text" class="form-control py-3" v-model="data.state" placeholder="State">
                          </div>
                        </div>
                        <div class="col-lg-12 col-12">
                          <label for="">Bio</label>
                          <textarea rows="3" class="form-control mb-4">
                            {{ data.marketstorebio }}
                          </textarea>
                        </div>
                      </div>
                      </div>
                      <div class="d-flex justify-content-end">
                        <button class="bg-button-responsive py-3" @click="updateprofile">Save Changes</button>
                      </div>
                    </div>
                    </div>
                  </div>


                 </TabPanel>
                 <TabPanel value="1">
                  Payments
                 </TabPanel>

                 <TabPanel value="2">
                  <div class="row">
                    <div class="col-lg-6">
                      <h1>Choose a preferred Location</h1>
                    </div>
                    <div class="col-lg-6">
                      <div class="card p-2 mb-3">
                         <div class="card-header px-2 p-2 mb-2">
                          Location Name
                         </div>

                         <div class="form-input mb-2">
                          <input type="text" class="form-control py-3" placeholder="Location">
                          </div>
                            <div class="alert d-flex align-items-start alert-info mb-0 h6" role="alert">
                              <span class="alert-icon me-4 rounded-circle"><i class="bx bx-info-circle bx-sm"></i></span>
                              This is your default location. To change whether you fulfill online orders from this location, select another default location first.
                            </div>
                      </div>

                      <div class="card p-2 mb-3">
                        <div class="card-header px-2 p-2 mb-2">
                         Address
                        </div>

                        <div class="form-input mb-2">
                         <input type="text" class="form-control py-3" placeholder="Country" value="Nigeria" readonly>
                         </div>
                           

                           <div class="row">
                            <div class="col-lg-4">
                              <div class="form-input mb-2">
                                <input type="text" class="form-control py-3" placeholder="Location">
                                </div>
                            </div>
    
                            <div class="col-lg-4">
                              <div class="form-input mb-2">
                                <input type="text" class="form-control py-3" placeholder="Location">
                                </div>
                            </div>
    
                            <div class="col-lg-4">
                              <div class="form-input mb-2">
                                <input type="text" class="form-control py-3" placeholder="Location">
                                </div>
                            </div>
                         </div>

                     </div>


                     <div class="d-flex justify-content-end px-2">
                      <button class="mealxpress-button btn">Submit</button>
                     </div>

                    
                    </div>
                  </div>
                 </TabPanel>
                 <TabPanel value="3">
                  <div class="col-12">
                    <h1 class="fs-4 mb-3">Password Setting</h1>

                    <div class="col-lg-12">
                       <div class="form-input mb-3">
                        <input type="text" placeholder="Enter Password" v-model="password" class="form-control py-3">
                       </div>

                       <div class="form-input mb-3">
                        <input type="text" placeholder="Confirm password" v-model="confirm" class="form-control py-3">
                       </div>

                       <div class="d-flex justify-content-end">
                        <button class="bg-button-responsive py-3" @click="updatePassword" >Update Password</button>
                       </div>


                    </div>

                  </div>
                 </TabPanel>

              </TabPanels>
          </Tabs>
    

          </div>
        </div>
    </div>  

</template>

<script>
  import NavbarComponent from './../../components/vendorsnav/aside.vue';
  import HeaderDashboard from './../../components/vendorsnav/header.vue';
  import '../../assets/mealxpresscustom/app.css';
  import '../../assets/mealxpresscustom/media.css';
  import {ref, reactive} from 'vue';
  import { Inertia } from '@inertiajs/inertia';
  
  import { useToast } from 'vue-toastification';
  import { usePage } from '@inertiajs/inertia-vue3';
  import Tabs from 'primevue/tabs';
  import TabList from 'primevue/tablist';
  import Tab from 'primevue/tab';
  import TabPanels from 'primevue/tabpanels';
  import TabPanel from 'primevue/tabpanel';
  import axios from 'axios';
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

export default{
    props:{
      data:{
        type:Object,
        required:false,
      }
    },
    methods:{
     async  updateprofile () {
        try {
          const toast = useToast();
          // Create form data from dataprofile
          const formData = {
            marketstorename:  this.data.marketstorename,
            marketstorebio: this.data.marketstorebio,
            marketstorelinks: this.data.marketstorelinks,
            marketreg: this.data.marketreg,
            marketstatus: this.data.marketstatus,
            marketsupportcourse: this.data.marketsupportcourse,
            marketstoreprofile: this.data.marketstoreprofile,
            marketstorecollection: this.data.marketstorecollection,
            activehours: this.data.activehours,
            contact: this.data.contact,
            legalbusiness: this.data.legalbusiness,
            email_address: this.data.email_address,
            sendermail: this.data.sendermail,
            city: this.data.city,
            marketstoreaddress: this.data.marketstoreaddress,
            state: this.data.state,
            };
          console.log(formData);

          const response = await axios.post('/vendorspath/updateprofile', formData, {
            headers: {
              'X-CSRF-TOKEN': csrfToken,
            },
          });

          if (response.status == 200) {
            const toast = useToast();
            toast.success(`${response.data.message}`,{
              hideProgressBar:true,
              timeout:3000,
            });
            console.log(response.data);
          } else {
            const toast = useToast();
            toast.info(`respons status code ${response.status}`);
            console.log(`response status ${response.status}`);
          }
        } catch (error) {
          const toast = useToast();
          toast.error('Something went wrong. Please try again. ' + error.message);
        }
      }
    },


  setup(){
   const props = usePage();
   const dataprofile = reactive(props.storelist || {});
   const isloading = ref(false);
   const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
   const toast = useToast();

   const password = ref('');
   const confirm = ref('');
   const datacall = ref('');



   const uploadprofile = async (event) => {
     const file = event.target.files[0];
     const formData = new FormData();
   
      formData.append('image', file);
    const response =  await axios.post('/vendorspath/updateprofileimage',formData, {
      'Content-Type': 'application/json',
    });
    try{
      const toast = useToast();
    if(response.status == 200){
     toast.success(response.data.message,{
      hideProgressBar:true,
      timeout: 2000,
     });
     Inertia.reload();
    }else{
      toast.success('Successful',{
      hideProgressBar:true,
      timeout: 2000,
     });
    }
    }catch(error){
      toast.success('Oops seems something went wrong, try again later',{
      hideProgressBar:true,
      timeout: 2000,
     });
      console.log('Error', error);
    }
   };




   const updatePassword  = async () =>{
      try{
        const toast = useToast();
          if(password.value !== confirm.value){
            toast.info('Password do not match', {
              hideProgressBar:true,
              timeout:2000,
            });
            return;
          }
          if(password.value == "" || confirm.value == ""){
            toast.error('Required fields empty', {
              hideProgressBar:true,
              timeout:2000,
            });
            return;
          }

        const payload = {
          password: password.value,
          confirm: confirm.value,
        }
        const response = await axios.post('/vendorspath/updateprofile',payload, {
        headers:{
          'Content-Type': 'multipart/form-data',
          'X-CSRF-TOKEN': csrfToken,
        }
        });
       
        if(response.status == 200){
           if(response.data.status == "success"){
            toast.success(response.data.message, {
              hideProgressBar:true,
              timeout:2000,
            });
           }else{
            const toast = useToast();
            toast.info('Not successful', {
              hideProgressBar:true,
              timeout:2000,
            });
           }
        }else{

        }

      }catch(error){
        console.log(error);
      }
   };

   return {
    dataprofile,
    password,
    confirm,
    updatePassword,
    uploadprofile,
   }      
    },


  data: () => ({
      tab: 'option-1',
    }),
    components:{
        NavbarComponent,
        HeaderDashboard,
        Tabs,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
    },

  
}
</script>