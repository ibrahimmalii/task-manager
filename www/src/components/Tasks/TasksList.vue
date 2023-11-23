<template>
  <table class="table table-hover">
    <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Completed</th>
      <th class="text-center" scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="task in tasks" :key="task.id">
      <td>{{ task.id }}</td>
      <td>{{ task.title }}</td>
      <td>{{ task.description }}</td>
      <td class="text-center">
        <input type="checkbox" @change="$emit('update', task)" :checked="task.completed"/>
      </td>
      <td class="d-flex">
        <RouterLink :to="{name: 'tasks.edit', params: {id: task.id}}" class="btn btn-primary">Edit</RouterLink>
        <button @click="deleteTask(task.id)" class="btn btn-danger ms-2">Remove</button>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<script setup>

defineProps({
  tasks: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(["update", "delete"]);

const deleteTask = (id) => {
  if(confirm('Are you sure?')) {
    emit('delete', id);
  }
};

</script>