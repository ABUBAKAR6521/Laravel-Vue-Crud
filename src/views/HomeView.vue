<script setup>
import {ref,onMounted} from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
let data = ref('');


const route = useRoute();
// var userUpdated = route.query.userUpdated === 'true';
// setTimeout(() => {
//   userUpdated = false;
// }, 2000);

onMounted(async ()=>{
  try{
    await axios.get('http://127.0.0.1:8000/api/contacts').then(response=>{
      data.value  =response.data.data
      // console.log(data.value)
    })
  }catch(error){
    console.log('error occured',error)
  }
})


const deleteContact = async (id)=>{
await axios.get(`http://127.0.0.1:8000/api/contacts/delete/${id}`).then(response =>{
  if(response.data.status == 200){
    alert(response.data.message)
    try{
     axios.get('http://127.0.0.1:8000/api/contacts').then(response=>{
      data.value  =response.data.data
      // console.log(data.value)
    })
  }catch(error){
    console.log('error occured',error)
  }
  }else{
    alert('Error Occured while deleting the contact')
  }
});



}

</script>

<template>
  <main>
    <div v-if="userUpdated">
      <div class="alert alert-success">
        User updated successfully!
      </div>
    </div>
 <div class="container">
  <div class="row mt-3">
    <div class="col-md-12 m-auto">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Designation</th>
            <th>Adress</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item,index) in data" :key="index">
            <td>{{ index }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
            <td>{{ item.dasignation }}</td>
            <td>{{ item.adress }}</td>
            <td>{{ item.phone }}</td>
            <td>
              <router-link class="btn btn-secondary btn-sm me-2" :to="{ name: 'Edit', params: { id: item.id } }">Edit</router-link>
              <button class="btn btn-danger btn-sm" @click.prevent="deleteContact(item.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
 </div>
  </main>
</template>
