<template>
  <div class="bg-drawer-center" v-if="addVisible">
    <div class="bg-drawer-center-container">
      <div class="d-flex justify-content-between px-5 py-5">
        <h1 class="fs-5">Add Category</h1>
        <div class="bg-circle" @click="$emit('close')">
          <i class="fas fa-x"></i>
        </div>
      </div>
      <div class="container-scrollable px-5">
        <!-- Multiselect Dropdown for Categories -->


        <multiselect 
        v-model="value"
        :options="options"
        :multiple="true"
        :close-on-select="false"
        :clear-on-select="false"
        :preserve-search="true"
        placeholder="Select category"
        class="mb-3"
        label="name"
        track-by="name"
        tag-placeholder="Add New Category"
        :class="{ 'multiselect-selected': value.length }"
        :preselect-first="true">
      </multiselect>
      </div>
  
      <!-- Submit Button -->
      <div class="py-4 px-5">
        <button class="bg-button-submit btn py-3" @click="submitProduct">
          {{ isLoadingProduct ? '....' : 'Add Category' }}
        </button>
      </div>
    </div>
  </div>
  
  </template>


  
  <script>

  import Multiselect from 'vue-multiselect';
  import axios from 'axios';
import { useToast } from 'vue-toastification';
import { Inertia } from '@inertiajs/inertia';
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


export default {
  props: {
    addVisible: Boolean, // Modal visibility
    data: Array, // Category data passed from parent
    isLoadingProduct: Boolean, // Loading state for the submit button
  },
  components: {
    Multiselect,
  },
  data() {
    return {
      inputname: '',
      inputprice: '',
      inputweight: '',
      kgcall: '',
      category: '', // Selected category for select dropdown
      image: null,
      fileName: null,
      value: [], // Selected values from the multiselect dropdown
      options: [], 
    };
  },
  methods: {
    fetchOptions() {
      // Fetch data from an API or process your existing data
      this.options = this.data.map(item => ({
        name: item.categoryname, // Format as needed
        language: 'Category', // Optional: Add a descriptor if needed
      }));
      console.log('Options: ',this.options);
    },
   
    // Handle file drop event
    HandleFileDrop(event) {
      event.preventDefault();
      const file = event.dataTransfer.files[0];
      if (file) {
        this.file = file;
      }
      this.previewImage(file);
    },

    addTag (newTag) {
      const tag = {
        name: newTag,
      }
      this.options.push(tag)
      this.value.push(tag)
    },
    // Trigger file input click
    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    // Handle file selection (manual file input)
    HandleFileChange(event) {
      const file = event.target.files[0];
      this.previewImage(file);
      if (file) {
        this.file = file;
      }
    },
    // Preview the selected image
    previewImage(file) {
      const reader = new FileReader();
      reader.onload = () => {
        this.image = reader.result; // Store the image URL for preview
      };
      reader.readAsDataURL(file);
    },

    // Handle the form submission
     async submitProduct() {
      if(this.value.length === 0){
        return;
      }
      console.log('Toggle now');
      // Prepare the form data to send to the backend
      const formData = new FormData();
      formData.append('value', JSON.stringify(this.value));    
      try{
      const response = await axios.post('/vendorspath/addcategory', formData,{
        headers:{
          'X-CSRF-TOKEN': csrfToken,
        }
      });
      if(response.status){
        const toast = useToast();
        toast.success(response.data.message,{
          hideProgressBar:true,
          timeout:3000,
        });
        Inertia.reload();
      console.log(response);
      }else{
        toast.error('Couldn\'t updated category',{
          hideProgressBar:true,
          timeout:3000,
        })
        console.log(response);
      }
    }catch(error){
      console.log(error);
    }
   
    },
  },
  mounted() {
    // Optional: You can fetch additional data if needed
    this.fetchOptions();
    console.log('Options for multiselect', this.options);
  },

};
    </script>

<style>
.multiselect__tag {
  background-color: #2D2942!important; /* Blue background */
  color: white; /* White text color */
  border-radius: 20px;
  padding: 5px 10px;
  font-size: 14px;
  margin-right: 5px;

}
/* Optional: Add hover effect to tags */
.multiselect__tag:hover {
  background-color: #2980b9!important; /* Darker blue on hover */
}
.multiselect__element:hover {
  background-color: #3498db; /* Blue background on hover */
  color: white; /* White text color on hover */
  cursor: pointer; /* Pointer cursor to indicate it's clickable */
}

/* Hover effect for selected tags (selected items) */
.multiselect__tag:hover {
  background-color: #2980b9!important; /* Darker blue on hover */
  color: white; /* White text color on hover */
  cursor: pointer; /* Pointer cursor to indicate the tag can be removed */
}

/* Optional: Customize the hover effect for the remove icon on tags */
.multiselect__tag__remove:hover {
  color: #e74c3c!important; /* Change the remove icon color to red on hover */
}


</style>
