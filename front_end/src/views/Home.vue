<script async setup>
import {ref} from "vue";
import {$api} from "@/utils/api..js";
import CourseCard from "@/components/CourseCard.vue";
const courses = ref([]);

$api('courses').then((res) => {
  courses.value = res;
});

</script>

<template>
  <div class="home container">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="course in courses" :key="course.id" class="bg-white shadow-md rounded-lg">
        <CourseCard :course="course" />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
