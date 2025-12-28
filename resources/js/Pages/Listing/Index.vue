<template>
    <div v-for="listing in listings" :key="listing.id">
        <div>
            <Link :href="route('listing.show', {listing: listing.id})">
                <ListingAddres :listing="listing"/>
            </Link>
        </div>
        <div>
            <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
        </div>
        <div>
            <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE">deleted</Link>
        </div>
    </div>
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue';
import { Link } from '@inertiajs/vue3';
    defineProps({
        listings: Array
    })
</script>