<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from "@/components/Navbar.vue";
import CategoryList from "@/components/CategoryList.vue";
import CategoriesCard from "@/components/CategoriesCard.vue";
</script>

<template>
  <div class="app">
    <Navbar />
    <div class="home container">
      <div class="grid grid-cols-4 gab-4">
        <div class="category-card col-span-1">
          <h1 class="text-2xl font-semibold">Categories</h1>
          <CategoriesCard class="mt-4" />
        </div>
        <div class="page-content col-span-3">
          <RouterView />

        </div>
      </div>
    </div>

  </div>
</template>

<style scoped>

</style>
