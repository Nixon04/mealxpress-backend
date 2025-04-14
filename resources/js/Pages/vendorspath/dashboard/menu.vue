<template>
    <div class="main-board-mealxpress">
      <NavbarComponent />
      <div class="mealxpress-content">
        <HeaderDashboard />
        <div class="mealxpress-main">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-8">
                  <!-- Product Information Section -->
                  <div class="card p-2 mb-3">
                    <h1 class="ms-4">Product Information</h1>
                    <div class="card-header">
                      <div class="form-header">
                        <div class="form-input mb-3">
                          <input
                            v-model="productTitle"
                            type="text"
                            class="form-control py-3"
                            placeholder="Product title"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <!-- Upload Food Image Section -->
                  <div class="card p-2">
                    <h1 class="ms-4">Upload food image</h1>
                    <div class="card-header">
                      
                      <div
                        class="dropzone"
                        @dragover.prevent="onDragOver"
                        @dragleave.prevent="onDragLeave"
                        @drop.prevent="onDrop"
                        :class="{ 'dropzone-active': isDragActive }"
                      >
                        <p v-if="!files.length">Drag files here or click to upload</p>
                        <p v-else>Files ready for upload:</p>
                        <ul>
                          <li v-for="(file, index) in files" :key="index">
                            {{ file.name }}
                          </li>
                        </ul>
                      </div>
                      <div v-if="imagePreview" class="image-preview">
                        <img :src="imagePreview" alt="Image preview" />
                      </div>
                      
                      <input
                        type="file"
                        ref="fileInput"
                        multiple
                        @change="onFileChange"
                        class="file-input"
                      />
                    </div>
  
                    <!-- Preview of selected image -->
                   
                  </div>
                </div>
  
                <!-- Pricing and Category Section -->
                <div class="col-lg-4">
                  <!-- Pricing Card -->
                  <div class="card p-2 mb-3">
                    <h1 class="mb-4 m-2">Pricing</h1>
                    <div class="form-header px-3">
                      <div class="form-input mb-3">
                        <input
                          v-model="price"
                          type="text"
                          class="form-control py-3"
                          placeholder="Amount"
                        />
                      </div>
                    </div>
                  </div>
  
                  <!-- Category Card -->
                  <div class="card p-2 mb-3">
                    <h1 class="mb-4 m-2">Category</h1>
                    <div class="form-header px-3">
                      <div class="form-input mb-3">
                        <select
                          v-model="category"
                          class="form-select py-3"
                        >
                          <option value="cloths">Cloths</option>
                          <!-- Add more options as needed -->
                        </select>
                      </div>
                    </div>
                  </div>
  
                  <button @click="submitForm" :disabled="!isFormValid" class="btn mealxpress-button w-100">Submit</button>
  
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Submit Button -->
  
      </div>
    </div>
  </template>
  
  <script>
  import { Inertia } from "@inertiajs/inertia";
  import NavbarComponent from './../../components/vendorsnav/aside.vue';
  import HeaderDashboard from './../../components/vendorsnav/header.vue';
  
  export default {
    components: {
      NavbarComponent,
      HeaderDashboard
    },
    data() {
      return {
        isDragActive: false, // Drag state for the dropzone
        files: [], // Array to hold files selected (dragged or via file input)
        productTitle: "", // Product title input field
        price: "", // Product price input field
        category: "", // Product category input field
        imagePreview: null, // Image preview URL
      };
    },
    computed: {
      // Check if the form is valid (all fields filled)
      isFormValid() {
        return this.productTitle && this.price && this.category && this.files.length;
      },
    },
    methods: {
      // Handle drag over event
      onDragOver(event) {
        this.isDragActive = true;
      },
      // Handle drag leave event
      onDragLeave(event) {
        this.isDragActive = false;
      },
      // Handle file drop event (for drag-and-drop)
      onDrop(event) {
        const droppedFiles = event.dataTransfer.files;
        this.handleFileSelection(droppedFiles);
        this.isDragActive = false;
      },
      // Handle file change event (for manual file upload)
      onFileChange(event) {
        const selectedFiles = event.target.files;
        this.handleFileSelection(selectedFiles);
      },
      // Handle files (either dragged or selected)
      handleFileSelection(files) {
        for (let i = 0; i < files.length; i++) {
          this.files.push(files[i]);
          // Preview the image
          if (files[i].type.startsWith('image')) {
            this.imagePreview = URL.createObjectURL(files[i]);
          }
        }
      },
      // Handle form submission
      async submitForm() {
        const formData = new FormData();
        
        // Append form fields to FormData
        formData.append("product_title", this.productTitle);
        formData.append("price", this.price);
        formData.append("category", this.category);
        
        // Append all selected files to FormData
        this.files.forEach((file, index) => {
          formData.append(`files[${index}]`, file);
        });
  
        try {
          // Submit the form using Inertia
          await Inertia.post("/your-upload-endpoint", formData, {
            onStart: () => {
              console.log("Uploading...");
            },
            onFinish: () => {
              console.log("Upload completed.");
            },
          });
  
          // Optionally reset the form after submission
          this.resetForm();
        } catch (error) {
          console.error("Error during form submission:", error);
        }
      },
      // Reset the form after submission
      resetForm() {
        this.productTitle = "";
        this.price = "";
        this.category = "";
        this.files = [];
        this.imagePreview = null;
        this.$refs.fileInput.value = null; // Clear the file input
      },
    },
  };
  </script>
  
  <style scoped>
  /* Styling for the dropzone */
  .dropzone {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    height: 200px;
    align-items: center;
    display: flex;
    justify-content: center;
    cursor: pointer;
  }
  
  .dropzone-active {
    border-color: #4CAF50;
    background-color: #f9f9f9;
  }
  
  .file-input {
    display: none;
  }
  
  button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
  }
  
  /* Styling for image preview */
  .image-preview {
    margin-top: 20px;
    text-align: center;
  }
  
  .image-preview img {
    max-width: 200px;
    max-height: 200px;
    object-fit: cover;
    border: 1px solid #ccc;
  }
  </style>
  