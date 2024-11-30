<script setup>
import { useRoute } from 'vue-router'
const {categories} = defineProps({
  categories: {
    type: Array,
    required: true,
  }
});

const route = useRoute();


</script>

<template>
  <div class="">
    <div v-for="category in categories" :key="category.id">
      <router-link
          :to="{name: 'category', params: {id: category.id}}"
          :class="{
            'text-md font-semibold hover:text-blue-500':true,
            'text-blue-500': route.params.id === category.id
          }">
        {{ category.name }}
      </router-link>
      <div v-if="category.children?.length" class="ml-4">
        <CategoryList :categories="category.children"/>
      </div>
    </div>
  </div>

</template>

<style scoped>
</style>
