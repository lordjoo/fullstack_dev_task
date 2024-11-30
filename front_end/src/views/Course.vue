<script async setup>
import CategoryList from "@/components/CategoryList.vue";
</script>

<template>
  <div class="home container">
    <div class="grid grid-cols-4 gab-4">
      <div class="category-card col-span-1">
        <h1 class="text-2xl font-semibold">Categories</h1>
        <CategoryList
            class="mt-4"
            :categories="categories"/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
