<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-12">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium texr-gray-500">
                Images
            </div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic Info
                </template>
                <Price :price="listing.price" class="text-3xl font-bold"/>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddres :listing="listing" class="text-gray-500"/>
            </Box>
            <Box>
                <template #header>
                    Offer
                </template>
                Make an offer
            </Box>
        </div>
    </div>
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/UI/Box.vue';
    defineProps({
        listing: Object,
    })
</script>