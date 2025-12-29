<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <Link :href="route('listing.show', {listing: listing.id})">
                    <Price :price="listing.price" class="text-3xl font-bold"/>
                    <ListingSpace :listing="listing" class="text-lg"/>
                    <ListingAddres :listing="listing" class="text-gray-500"/>
                </Link>
            </div>
            <div>
                <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
            </div>
            <div>
                <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE">deleted</Link>
            </div>
        </Box>
    </div>   
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/UI/Box.vue';
import { Link } from '@inertiajs/vue3';
    defineProps({
        listings: Array
    })
</script>