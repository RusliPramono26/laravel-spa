<template>
    <div>You must verify your email to see this page</div>
    <Link :href="route('verification.send')" method="post" as="button" class="text-indigo-800 dark:text-indigo-500">Resend verification email</Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy';


</script>