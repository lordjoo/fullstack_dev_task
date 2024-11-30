<script setup>
import CategoryList from "@/components/CategoryList.vue";
import {ref} from "vue";
import {$api} from "@/utils/api..js";

const categories = ref([]);
const courses = ref([]);

const buildCategoryTree = (categories, parentId = null) => {
  return categories
      .filter(category => category.parent_id === parentId && !category.hasOwnProperty('children')) // Ignore already mapped categories
      .map(category => {
        const children = buildCategoryTree(categories,category.id);
        return {
          ...category,
          children, // Add children to the category
        };
      });
};

$api('categories').then((res) => {
  categories.value = buildCategoryTree(res);
  console.log(categories.value);
});
</script>

<template>
  <CategoryList :categories="categories"/>
</template>

<style scoped>

</style>
