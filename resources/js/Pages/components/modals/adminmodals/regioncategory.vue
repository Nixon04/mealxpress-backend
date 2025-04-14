<template>
    <div class="bg-drawer-center" v-if="addVisible">
      <div class="bg-drawer-center-container">
        <div class="d-flex justify-content-between overlay-topcardspad">
          <h1 class="fs-5 text-main fw-bold">Add Regions</h1>
          <div class="bg-circle" @click="$emit('close')">
            <i class="fas fa-x"></i>
          </div>
        </div>
        <div class="container-scrollable overlay-topcardspad">
            <div class="input-spacing mb-3">
              <select name="" id=""  v-model="states" class="form-select py-3">
                <option value="" selected disabled>Select</option>
                <option value="Abia">Abia</option>
                <option value="Adamawa">Adamawa</option>
                <option value="Akwa Ibom">Akwa Ibom</option>
                <option value="Anambra">Anambra</option>
                <option value="Bauchi">Bauchi</option>
                <option value="Bayelsa">Bayelsa</option>
                <option value="Benue">Benue</option>
                <option value="Borno">Borno</option>
                <option value="Cross River">Cross River</option>
                <option value="Delta">Delta</option>
                <option value="Ebonyi">Ebonyi</option>
                <option value="Edo">Edo</option>
                <option value="Ekiti">Ekiti</option>
                <option value="Enugu">Enugu</option>
                <option value="Gombe">Gombe</option>
                <option value="Imo">Imo</option>
                <option value="Jigawa">Jigawa</option>
                <option value="Kaduna">Kaduna</option>
                <option value="Kano">Kano</option>
                <option value="Katsina">Katsina</option>
                <option value="Kebbi">Kebbi</option>
                <option value="Kogi">Kogi</option>
                <option value="Kwara">Kwara</option>
                <option value="Lagos">Lagos</option>
                <option value="Nasarawa">Nasarawa</option>
                <option value="Niger">Niger</option>
                <option value="Ogun">Ogun</option>
                <option value="Ondo">Ondo</option>
                <option value="Osun">Osun</option>
                <option value="Oyo">Oyo</option>
                <option value="Plateau">Plateau</option>
                <option value="Rivers">Rivers</option>
                <option value="Sokoto">Sokoto</option>
                <option value="Taraba">Taraba</option>
                <option value="Yobe">Yobe</option>
                <option value="Zamfara">Zamfara</option>
                <option value="FCT">FCT</option>
              </select>
            </div>

            <div class="input-spacing mb-3">
              <input
              type="text"
              v-model="locationInput"
              class="form-control py-3"
              placeholder="Start typing your area (e.g. Choba, Elekahia)..."
              @focus="showSuggestions = true"
              @blur="setTimeout(() => showSuggestions = false, 150)"
            />

            <ul v-if="showSuggestions && filteredLocations.length" class="list-group position-absolute z-10">
              <li
                class="list-group-item"
                v-for="(location, index) in filteredLocations"
                :key="index"
                @click="selectLocation(location)"
                style="cursor: pointer;"
              >
                <span class="text-white">{{ location }}</span>
              </li>
            </ul>

            </div>

            <div class="py-4 px-0">
             

              <button :class="[ isOptionLoading ? 'bg-button-submit btn py-3 cursor-not-allowed' : 'bg-button-submit btn py-3'] " @click="submitProduct">
                <span v-if="isOptionLoading" class="flex items-center">
                  <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                    </path>
                  </svg>
                  Loading...
                </span>
                <span v-else>Add Region</span>
              </button>
            </div>

         </div>
         </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { ref, watch } from 'vue';
  import { useToast } from 'vue-toastification';
  import { Inertia } from '@inertiajs/inertia';
  
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  
  export default {
  data () {
    return {
      isOptionLoading: false,
      locationInput: '',
      states: '',
      showSuggestions: false,
      locations: [
        "Abuloma", "Agip", "Amadi Ama", "Borokiri", "Bundu Ama", "Choba", "D-line",
        "Diobu", "Eagle Island", "Elekahia", "Elelenwo", "Fimie Ama", "Koko Ama",
        "Marine Base", "New GRA", "Nkpogu", "Nkpolu Oroworukwo", "Ogbunabali", "Old GRA",
        "Old Port Harcourt Township", "Oroabali", "Oroada", "Orochiri", "Orogbum",
        "Orolozu", "Oromeruezimgbu", "Oroworukwo", "Oromineke", "Ozuboko Ama", "Rebisi",
        'rumuokoro',
        "Rumukalagbor", "Rumuobiekwe", "Rumuwoji", "Tere-Ama", "Okuru-Ama"
      ]
    }
  },


  computed: {
    filteredLocations() {
    if (!this.locationInput) return [];
    return this.locations.filter(loc =>
      loc.toLowerCase().includes(this.locationInput.toLowerCase())
    );
  }
  },
    props: {
      addVisible: Boolean,
      data: Array,
      isLoadingProduct: Boolean,
    },
   
    methods: {
      selectLocation(location) {
      this.locationInput = location;
      this.showSuggestions = false;
     },


       async submitProduct ()  {
        this.isOptionLoading = true;
        const toast = useToast();
        try{

          if(!this.states || !this.locationInput){
            toast.info('Input field is required');
            return;
          }
        const url =  "/prisent/dashboard/regions";
        const payload = {
           states: this.states,
          locationInput: this.locationInput,
        };
        const response  = await axios.post(url, payload,{
          headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        });
        if(response.status == 200){
          toast.success(response.data.message, {
            hideProgressBar:true,
            timeout:300,
          });
          Inertia.reload();
        }else{

        }
      }catch(e){
        console.log(e);
      }
      finally{
        this.isOptionLoading = false;
      }
    }

    }
    
  
  
  };
  </script>
  
  <style scoped>
 
  

  </style>
  