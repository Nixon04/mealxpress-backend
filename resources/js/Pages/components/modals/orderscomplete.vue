<template>
    <div v-if="isVisible" class="bg-dialog-modal-container">
        <div class="bg-dialog-pad m-1">
            <div class="bg-scrollabl">
            <div class="header ms-4 me-4 py-3 d-flex justify-content-between">
                <h1 class="fs-3 fw-bold">Product List</h1>
                <div class="bg-circle" @click="$emit('close')">
                        <div class="fas fa-x fas-sm" ></div>
                    </div>
            </div>
            <div class="bg-scrollable-meal mb-4">
                <div  v-if="loading" class="d-flex ">
                    <div class="rounded">
                        <div class="flex mb-4 w-100">
                            <Skeleton shape="circle" size="4rem" class="mr-2 shimmer-color"></Skeleton>
                            <div>
                                <Skeleton width="10rem" class="mb-2 shimmer-color p-4" style="background-color: #f1f1f1"></Skeleton>
                                <Skeleton width="5rem" class="mb-2 p-4 shimmer-padding"  style="background-color: #f1f1f1"></Skeleton>
                                <Skeleton height=".5rem" class="p-4"  style="background-color: #f1f1f1"></Skeleton>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else-if="ModalData" class="meal-details mb-5">
                    <div v-for="(item, index) in ModalData" :key="index.id" class="mb-4">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <span>Meal:</span>
                            <div class="d-flex gap-3 align-items-center">
                                <img :src="item.cartimage" alt="Meal Image" style="width:40px;height:40px" class="mb-2 "/>
                                <h2>{{ item.productname }}</h2>
                            </div>
  
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Price:</span>
                            <p>{{ formattedPrice(item.price) }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Total:</span>
                            <p class="fw-bold">{{ item.total }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Weight:</span>
                            <p class="">{{ item.cartweight }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Drink </span>
                            <img :src="item.option" alt="Meal Image" style="width:40px;height:40px" class="mb-2 "/>
                        </div>
                        <hr />
                      </div>
                  </div>

            </div>
      <!-- button -->

      <div :class="[loadingstate ? 'bg-lazyloading text-center  p-3 cursor-not-allowed mb-3 opacityloading' : 'bg-button-submit-secondary text-center p-3 cursor-pointer mb-3']"  @click=" !loadingstate && approveOrder(approveOrder(ModalData[0]?.cartrefcode))">
        <span class="text-white">{{loadingstate ? 'Loading....' : 'Accept Order'}}</span>
      </div>

      <div :class="[isLoading ? 'bg-lazyloading  text-center p-3 cursor-pointer' : 'bg-button-light text-center  p-3 cursor-pointer']"  @click="submitrequest( !isLoading &&  submitrequest(ModalData[0]?.cartrefcode))" :disable="loadingstate">
        <span class="text-white">{{isLoading ? 'Loading....' : 'Reject Order'}}</span>
      </div>
      <!-- end of button -->
        </div>
       </div>
    </div>
</template>

<script>

import {ref} from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { Inertia } from '@inertiajs/inertia';
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export default{
    props:{
        isVisible:Boolean,
        ModalData:Array,
        loading:Boolean,
    },
    methods:{
        closeModal(){
            this.$emit('close');
        },
        formattedPrice(price){
         if(price == ""  ||  price == undefined) return;
         return parseFloat(price).toLocaleString('en-NG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
         });
        }
    },
   setup(props, {emit}){
    const isLoading = ref(false);
    const loadingstate = ref(false);
    const toast = useToast();
    const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));
    const closeModal = () =>{
      emit('close');
    };

    const approveOrder =  async (cartrefcode) => {
        if(loadingstate.value){
            console.log('function already in loading state');
            return;
        }
        loadingstate.value = true;
        await delay(3000);
        const payload  = {
           cartstatusreport: 'accepted',   
           cartrefparam:  cartrefcode
        }
       try{
        const response = await axios.post('/vendorspath/updatetrackgoods', payload,{
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        });
        if(response.status){
            const toast = useToast();
            toast.success(response.data.message,{
                hideProgressBar:true,
                timeout:3000,
            });

            await delay(3000);
            console.log(response.status);
            Inertia.reload();
        }else{
            toast.info(response.data.message,{
                hideProgressBar:true,
                timeout:3000,
            });
        }
       }catch(error){
        console.log('Error', error);
       }
        finally{
            loadingstate.value = false;
        }

    };

    const submitrequest = async (cartrefcode) => {
    try {
      isLoading.value = true;
        await delay(300);
        const payload = {
            itemupdate: "returns",
            cartref: cartrefcode, // Use the first cartrefcode
        };
        const response = await axios.post('/vendorspath/rejectorder', payload, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        });

        if (response.status === 200) {
            if (response.data.status === "success") {
                toast.success(response.data.message, {
                    timeout: 2000,
                    hideProgressBar: true,
                });
                closeModal();
            } else {
                toast.info(response.data.message, {
                    timeout: 2000,
                    hideProgressBar: true,
                });
                closeModal();
            }
        } else {
            console.log('Unexpected status code:', response.status);
        }
    } catch (error) {
        console.error('Error occurred:', error);
        toast.error('An error occurred while processing your request.');
    } finally {
        isLoading.value = false;
    }
};
    return {
        isLoading,
        submitrequest,
        closeModal,
        approveOrder,
        loadingstate
    }
   }
}
</script>

