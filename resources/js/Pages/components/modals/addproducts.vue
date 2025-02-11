<template>
    <div class="bg-drawer-center" v-if="addVisible">
      <div class="bg-drawer-center-container">
        <div class="d-flex justify-content-between px-5 py-5">
          <h1 class="fs-5 fw-bold">Add Product</h1>
          <div class="bg-circle" @click="$emit('close')">
            <i class="fas fa-x"></i>
          </div>
        </div>
        <div class="container-scrollable px-3">
          <!-- Product Name Input -->
          <div class="form-input mb-3">
            <label for="InputProduct">Product Name</label>
            <input
              type="text"
              v-model="inputname"
              id="InputProduct"
              class="form-control py-3"
              placeholder="Enter Product Name"
            />
          </div>
  
          <!-- Product Price Input -->
          <div class="form-input mb-3">
            <label for="InputPrice">Product Price</label>
            <input
              type="number"
              v-model="inputprice"
              id="InputPrice"
              class="form-control py-3"
              placeholder="Enter Product Price"
            />
          </div>

         <div class="form-input mb-3">
            <label for="inputCategory">Category</label>
            <div v-if="cat.length == 0">Please add category to be liable to post <Link class="bg-button-submit py-2 ms-2 rounded-3xl" href="/vendorspath/dashboard/addcategories">Add Category</Link></div>
            <div v-else>
              <select id="inputCategory"  v-model="category" class="form-select py-3 w-100">
                <option v-for="(item, index) in cat" :key="index">
                    {{ item.categoryname }}
                </option>
            </select>
            </div>
         </div>
  
          <!-- Product Weight Input -->
          <div class="form-input mb-3">
            <label for="InputWeight">Product Weight</label>
              <div class="d-flex">
                <input  
                type="number"
                v-model="inputweight"
                id="InputWeight"
                class="form-control py-3"
                placeholder="Enter Product Weight"
                style="flex:10"
              />
              <select  class="form-select py-3" v-model="kgcall" style="flex:1">
                <option value="" selected disabled>Choose a unit for your good(s)</option>
                <option value="g">Grams (g)</option>
                <option value="kg">Kilograms (kg)</option>
                <option value="mg">Milligrams (mg)</option>
                <option value="oz">Ounces (oz)</option>
                <option value="lb">Pounds (lb)</option>
                <option value="t">Tons (t)</option>
              </select>
            </div>
          </div>
  
          <!-- File Drag-and-Drop Input -->
          <div class="form-input mb-3">
            <div
              class="drag-content-container"
              @dragover.prevent
              @drop="HandleFileDrop"
              @click="triggerFileInput"
            >
              <div class="content-write">
                <h1>{{image? '' : 'Drag or upload manually'}}</h1>
                <div v-if="image">
                    <img :src="image" alt="Product Image" class="uploaded-image" />
                  </div>
                <div class="d-none">
                  <input
                    type="file"
                    ref="fileInput"
                    style="display: none"
                    @change="HandleFileChange"
                  />
                </div>
              </div>
            </div>
           
          </div>
        </div>
  
        <!-- Submit Button -->
        <div class="py-4 px-5">
          <button :class="[ isLoadingProduct ? 'bg-button-submit btn py-3 cursor-not-allowed' :  'bg-button-submit btn py-3' ]" @click="submitProduct">
            {{ isLoadingProduct ? '....' : 'Add Product' }}
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3';
  export default {
    
    props: {
      addVisible: Boolean, // Modal visibility
      cat:Array,
      isLoadingProduct: Boolean,
    },
    data() {
      return {
        inputname: '',
        inputprice: '',
        inputweight: '',
        kgcall: '',
        category: '',
        image: null,
        fileName: null, 
      };
    },
    components:{
      Link,
    },
    methods: {

      // Handle the file drop
      HandleFileDrop(event) {
        event.preventDefault();

        const file = event.dataTransfer.files[0];
        if(file){
            this.file  = file;
        }
        this.previewImage(file);
      },
  
      // Trigger the hidden file input when clicked
      triggerFileInput() {
        this.$refs.fileInput.click();
      },
  
      // Handle file selection (manual file input)
      HandleFileChange(event) {
        const file = event.target.files[0];
        this.previewImage(file);
        if(file){
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
      submitProduct() {

        if (!this.inputname || !this.inputprice || !this.inputweight || !this.image || !this.kgcall) {
          console.log('Please fill out all fields and upload an image.');
          return;
        }
        // Prepare the form data to send to the backend
        const formData = new FormData();
        formData.append('productName', this.inputname);
        formData.append('productPrice', this.inputprice);
        formData.append('productWeight', this.inputweight);
        formData.append('productCategory', this.category);
        formData.append('kgcall', this.kgcall);
        formData.append('productImage', this.file); // Send the image data
  
        this.$emit('submitmodal', formData);
        // this.$emit('close');
      },
    },
  };
  </script>
  
  <style scoped>
  .uploaded-image {
    max-width: 100%;
    max-height: 100px;
    margin-top: 10px;
  }
  </style>
  