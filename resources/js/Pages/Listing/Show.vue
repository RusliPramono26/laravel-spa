<template>
    <div>
        <ListingAddres :listing="listing"/>
    </div>
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue';
    defineProps({
        listing: Object,
    })
</script>