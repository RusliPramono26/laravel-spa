<template>
    <Link href="/listing">Listing</Link>&nbsp;
    <Link href="/listing/create">New Listing</Link>
    <div v-if="flashSuccess" class="success">
      {{ flashSuccess }}
    </div>
    <slot></slot>
</template>

<script setup>
  import { Link, usePage } from '@inertiajs/vue3';
  import { computed } from 'vue';

  const page = usePage()

  const flashSuccess = computed(
    () => page.props.flash.success, 
  )
  // const timer = ref(0)
  // setInterval(()=>timer.value++,1000)
</script>

<style scoped>
  .success {
    background-color: green;
    color: white;
  }
</style>

