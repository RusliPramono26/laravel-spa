<template>
  <div class="flex gap-1">
    <template v-for="(link, index) in links" :key="index">
      
      <!-- DISABLED LINK -->
      <span
        v-if="!link.url"
        class="py-2 px-4 rounded-md text-gray-400 cursor-not-allowed"
        v-html="link.label"
      />

      <!-- ACTIVE / NORMAL LINK -->
      <Link
        v-else
        class="py-2 px-4 rounded-md"
        :href="link.url"
        :class="{
          'bg-indigo-500 dark:bg-indigo-800 text-white': link.active,
          'text-gray-700 dark:text-gray-300': !link.active
        }"
        v-html="link.label"
      />
    </template>
  </div>
  
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
defineProps({links: Array})
</script>