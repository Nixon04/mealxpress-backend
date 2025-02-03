<template>
    <div class="bg-drawer-center" v-if="addVisible">
      <div class="bg-drawer-center-container">
        <div class="d-flex justify-content-between px-5 py-5">
          <h1 class="fs-5 fw-bold">Add Drinks</h1>
          <div class="bg-circle" @click="$emit('close')">
            <i class="fas fa-x"></i>
          </div>
        </div>
        <div class="container-scrollable px-5">

        
          <div class="form-input mb-3">
            <label for="business">Drink Name</label>
            <input
              type="text"
              v-model="drinkname"
              id="state"
              class="form-control py-3"
              placeholder="Add Drinks"
            />
          </div>

          <div class="form-input mb-3">
            <label for="price">Drink Price</label>
            <input
              type="text"
              v-model="drinkprice"
              id="price"
              class="form-control py-3"
              placeholder="Drink Price"
            />
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
          <button class="bg-button-submit btn py-3" @click="submitProduct">
            {{ isOptionLoading ? 'Loading...' : 'Add Drink' }}
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { useToast } from 'vue-toastification';
  import axios from 'axios';
  const toast = useToast();
  export default {
    
    props: {
      addVisible: Boolean, // Modal visibility
      cat:Array,
      isOptionLoading:Boolean,
    },
    data() {
      return {
        drinkname: '',
        drinkprice: '',
        image: null,
      };
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
  
                triggerFileInput() {
                if (!this.$refs || !this.$refs.fileInput) {
                    console.error("File input element not found.");
                    return;
                }
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
        if (!this.drinkname || !this.drinkprice || !this.file
         
        ) {
          console.log('Please fill out all fields and upload an image.');
          toast.info('Required fields still empty',{
            timeout: 2000,
            hideProgressBar:true,
          });
          return;
        }
        // Prepare the form data to send to the backend
        const formData = new FormData();
        formData.append('drinkname', this.drinkname)
        formData.append('drinkprice', this.drinkprice);
        formData.append('drinkimage', this.file);
        this.$emit('submitmodal', formData);
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
  