<script setup>
import router from '@/Routes';
import axios from 'axios';
import { useRoute } from 'vue-router';
const route = useRoute();
import { ref, onMounted} from 'vue';


let form = ref({
    name: '',
    email: '',
    phone: '',
    dasignation: '',
    adress: ''
});

onMounted(async () => {
    await axios.get(`http://127.0.0.1:8000/api/contacts/edit/${route.params.id}`).then(response => {
        const userData = response.data.data; 
        // Copy individual properties from userData to form
        form.value.name = userData.name;
        form.value.email = userData.email;
        form.value.phone = userData.phone;
        form.value.dasignation = userData.dasignation;
        form.value.adress = userData.adress;
    });
})

const updateContact =async()=>{
        let formData= new FormData();
        formData.append('name', form.value.name);
        formData.append('email', form.value.email);
        formData.append('dasignation', form.value.dasignation);
        formData.append('phone', form.value.phone);
        formData.append('adress', form.value.adress);
        try{
          await axios.post(`http://127.0.0.1:8000/api/contacts/update/${route.params.id}`,formData).then(response=>{
           console.log(response.status)
           form.value.name = '';
           form.value.email = '';
           form.value.phone = '';
           form.value.dasignation = '';
           form.value.adress = '';
           router.push('/');
        //    router.push({ path: '/', query: { userUpdated: 'true' } });
    })
        }catch(error){
    console.log('error occured',error)
  }

}



</script>



<template>
<div class="container">
  <div class="row">
    <div class="col-md-6">
     <form action="" @submit.prevent="updateContact">

      <div class="mb-3">
        <label for="Name">Name</label>
        <input type="text" class="form-control" v-model="form.name"/>
    
      </div>
      <div class="mb-3">
        <label for="Email">Email</label>
        <input type="email" class="form-control" v-model="form.email" />

      </div>
      <div class="mb-3">
        <label for="dasignation">Dasignation</label>
        <input type="text" class="form-control" v-model="form.dasignation"/>
   
      </div>
      <div class="mb-3">
        <label for="Phone">Phone</label>
        <input type="tel" class="form-control" v-model="form.phone"/>

      </div>
      <div class="mb-3">
        <label for="Adress">Adress</label>
        <input type="text" class="form-control" v-model="form.adress"/>
     
      </div>

      <button class="btn btn-success" type="submit"> Submit</button>

     </form>
    </div>
  </div>
</div>


</template>
