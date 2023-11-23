<template>
  <main class="container">
      <BaseHeader title="Tasks" action="Add new task" routeName="tasks.create" />
      <TasksList v-if="isLoaded" :tasks="tasks" @update="updateTaskStatus" @delete="deleteTask"/>
      <BaseSpinner v-else />
  </main>
</template>

<script setup>
import TasksList from "@/components/Tasks/TasksList.vue";
import {onMounted, ref} from "vue";
import axiosInstance from "@/axios/config";
import BaseHeader from "@/components/BaseHeader.vue";
import BaseSpinner from "@/components/BaseSpinner.vue";


const tasks = ref([]);
const isLoaded = ref(false);

onMounted(() => {
  getTasks();
});

const getTasks =  () => {
  axiosInstance.get("/tasks").then(res => {
    tasks.value = res.data.data;
    isLoaded.value = true;
  }).catch(console.error);
};

const updateTaskStatus = (task) => {
  const body ={
    ...task,
    completed: !task.completed,
  };
  axiosInstance.put(`/tasks/${task.id}`, body)
      .then(() => getTasks())
      .catch(console.error);
};

const deleteTask = (id) => {
  axiosInstance.delete(`/tasks/${id}`).then(() => {
    getTasks();
  }).catch(console.error);
};
</script>