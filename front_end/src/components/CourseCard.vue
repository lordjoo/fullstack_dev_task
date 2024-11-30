<template>
  <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Image Container with Positioning -->
    <div class="relative">
      <!-- Course Image -->
      <img class="w-full object-cover" :src="course.preview" alt="Course Image" />

      <!-- Category Name in the Top Right Corner -->
      <div class="absolute top-2 right-2 bg-blue-600 text-white text-sm font-semibold px-3 py-1 rounded-md">
        {{ course.main_category_name }}
      </div>
    </div>

    <!-- Course Information -->
    <div class="p-3">
      <!-- Course Title -->
      <h3 class="text-lg font-semibold text-gray-800">{{ course.name }}</h3>
      <!-- Truncated Course Description -->
      <p class="text-gray-600 mt-1">
        {{ truncateDescription(course.description, 100) }}
      </p>
    </div>
  </div>
</template>

<script setup>
// Define the prop 'course' which will be passed into the component
const props = defineProps({
  course: {
    type: Object,
    required: true
  }
});

// Function to truncate text after a specified number of characters
const truncateDescription = (text, maxLength) => {
  if (text.length > maxLength) {
    return text.slice(0, maxLength) + '...';
  }
  return text;
};
</script>

<style scoped>
/* Optional custom styling (e.g., to add hover effects or other styles) */
</style>
