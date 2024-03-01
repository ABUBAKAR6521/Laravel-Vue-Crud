<script setup>
import router from '@/Routes';
import axios from 'axios';
import { ref, computed } from 'vue';


let form = ref({
    name: '',
    email: '',
    phone: '',
    dasignation: '',
    adress: ''
});

let isValidName = computed(() => form.value.name.trim() !== "");
let isValidEmail = computed(() => form.value.email !== "");
let isValidDasignation = computed(() => form.value.dasignation !== "");
// let isValidPhone = computed(() => form.value.phone.length <= 11); // Adjusted phone validation
let isValidAdress = computed(() => form.value.adress !== "");

// Ensure all validation checks are truthy
let isValidData = computed(() => isValidName.value && isValidEmail.value && isValidDasignation.value && isValidAdress.value);

const submitForm =async () => {
    if (isValidData.value) {
        let formData = new FormData();
        formData.append('name', form.value.name);
        formData.append('email', form.value.email);
        formData.append('dasignation', form.value.dasignation);
        formData.append('phone', form.value.phone);
        formData.append('adress', form.value.adress);
        try{
          await axios.post('http://127.0.0.1:8000/api/contacts/create',formData).then(response=>{
           console.log(response.status)
           form.value.name = '';
           form.value.email = '';
           form.value.phone = '';
           form.value.dasignation = '';
           form.value.adress = '';
           router.push('/')
    })
        }catch(error){
    console.log('error occured',error)
  }

    } else {
        console.log('Form Not Submitted');
    }
}
</script>



<template>
<div class="container">
  <div class="row">
    <div class="col-md-6">
     <form action="" @submit.prevent="submitForm">

      <div class="mb-3">
        <label for="Name">Name</label>
        <input type="text" class="form-control" v-model="form.name"/>
        <span v-if="!isValidData" class="text-danger">This field is Required</span>
      </div>
      <div class="mb-3">
        <label for="Email">Email</label>
        <input type="email" class="form-control" v-model="form.email" />
        <span v-if="!isValidData" class="text-danger">This field is Required</span>
      </div>
      <div class="mb-3">
        <label for="dasignation">Dasignation</label>
        <input type="text" class="form-control" v-model="form.dasignation"/>
        <span v-if="!isValidData" class="text-danger">This field is Required</span>
      </div>
      <div class="mb-3">
        <label for="Phone">Phone</label>
        <input type="tel" class="form-control" v-model="form.phone"/>
        <span v-if="!isValidData" class="text-danger">This field is Required</span>
      </div>
      <div class="mb-3">
        <label for="Adress">Adress</label>
        <input type="text" class="form-control" v-model="form.adress"/>
        <span v-if="!isValidData" class="text-danger">This field is Required</span>
      </div>

      <button class="btn btn-success" type="submit"> Submit</button>

     </form>
    </div>
  </div>
</div>


</template>
