<template>
      <div>Index Page</div>
      <Link href="/hello">Show Page</Link>
      <div>
        this message from {{ message }}
      </div>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
  defineProps({ message: String })
</script>