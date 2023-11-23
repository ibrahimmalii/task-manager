<template>
  <div class="container">
    <h1>Update Task</h1>
    <div v-if="message" class="alert alert-danger text-center" role="alert">
      {{ message }}
    </div>
    <form v-if="task" @submit.prevent="updateTask()">
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
      <div class="my-3">
        <label for="completed">Completed</label>
        <select class="form-control" v-model="task.completed" id="completed">
          <option v-for="status in taskStatus" :key="status.value" :value="status.value"
                  :selected="status.value === task.completed"
          >
            {{ status.label }}
          </option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <BaseSpinner v-else />
  </div>
</template>

<script setup>
import axiosInstance from "@/axios/config";
import router from "@/router";
import {onMounted, ref} from "vue";
import BaseSpinner from "@/components/BaseSpinner.vue";

let message = ref('');
let isSubmitted = ref(false);

let task = ref({
  title: '',
  description: '',
  completed: false,
});

const taskStatus = [
  {
    value: 1,
    label: 'Yes',
  },
  {
    value: 0,
    label: 'No',
  },
];

onMounted(() => {
  getTask();
});

const getTask = async () => {
  console.log('here')
  try {
    const response = await axiosInstance.get(`/tasks/${router.currentRoute.value.params.id}`);
    task.value = response.data.data;
    console.log('task', task.value);
  } catch (error) {
    console.error("Error fetching tasks:", error);
  }
};

const updateTask = () => {
  isSubmitted.value = true;
  if (!task.value.title || !task.value.description) {
    return;
  }
  isSubmitted.value = false;
  axiosInstance.put(`/tasks/${task.value.id}}`, task.value).then(() => {
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