<template>
  <div class="d-flex justify-content-between mb-3">
    <h1>{{ title }}</h1>
    <RouterLink class="btn btn-link" :to="{name: routeName}">{{ action }}</RouterLink>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
  action: {
    type: String,
    required: true,
  },
  routeName: {
    type: String,
    required: true,
  },
});

defineEmits(["create"]);
</script>