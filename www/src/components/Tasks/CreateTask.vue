<template>
  <div class="container">
    <h1>Create Task</h1>
    <div v-if="message" class="alert alert-danger text-center" role="alert">
      {{ message }}
    </div>
    <form @submit.prevent="createNewTask()">
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" v-model="task.title" id="title" placeholder="Enter title">
        <small v-if="isSubmitted && !task.title" class="text-danger">Title is required</small>
      </div>
      <div class="form-group my-3">
        <label for="description">Description</label>
        <textarea class="form-control" v-model="task.description" id="description" rows="3"></textarea>
        <small v-if="isSubmitted && !task.description" class="text-danger">Description is required</small>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script setup>
import axiosInstance from "@/axios/config";
import router from "@/router";
import {ref} from "vue";

let message = ref('');
let isSubmitted = ref(false);

let task = {
  title: '',
  description: '',
};

const createNewTask = () => {
  isSubmitted.value = true;
  if (!task.title || !task.description) {
    return;
  }
  isSubmitted.value = false;
  axiosInstance.post('/tasks', task).then(() => {
    router.push({name: 'tasks.index'});
  }).then(console.log).catch((err) => {
    message.value = err.response.data.message;
    hideAlert();
  });
};

const hideAlert = () => {
  setTimeout(() => {
    message.value = '';
  }, 3000);
};

</script>