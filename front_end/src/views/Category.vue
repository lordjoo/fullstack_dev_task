<script setup>
import {ref,watch} from "vue";
import {$api} from "@/utils/api..js";
import {useRoute} from "vue-router";
import CourseCard from "@/components/CourseCard.vue";

const category = ref({});
const courses = ref([]);
const route = useRoute();

fetchData();

watch(() => route.params.id, async () => {
  fetchData();
});

function fetchData() {
  $api(`/categories/${route.params.id}/courses`).then((res) => {
    courses.value = res;
  });
  $api(`/categories/${route.params.id}`).then((res) => {
    category.value = res;
  });
}

</script>

<template>
  <div class="category-page">
    <div class="category-header text-center">
      <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ category.name }}</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="course in courses" :key="course.id" class="bg-white shadow-md rounded-lg">
        <CourseCard :course="course" />
      </div>
    </div>
  </div>
</template>
