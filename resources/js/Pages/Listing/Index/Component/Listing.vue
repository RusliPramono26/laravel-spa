<template>
    <Box>
            <div>
                <Link :href="route('listing.show', {listing: listing.id})">
                    <div class="flex items-center gap-1">
                        <Price :price="listing.price" class="text-3xl font-bold"/>
                        <div class="text-xs text-gray-500">
                            <Price :price="mothlyPayment"/>pa
                        </div>
                    </div>
                    <ListingSpace :listing="listing" class="text-lg"/>
                    <ListingAddres :listing="listing" class="text-gray-500"/>
                </Link>
            </div>
            <div v-if="user">
                 <div>
                    <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
                </div>
                <div>
                    <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE">deleted</Link>
                </div>
            </div>
    </Box>
</template>

<script setup>
    import ListingAddres from '@/Component/ListingAddres.vue';
    import ListingSpace from '@/Component/ListingSpace.vue';
    import Price from '@/Component/Price.vue';
    import Box from '@/Component/UI/Box.vue';
    import { useMonthlPayment } from '@/Composables/useMonthlyPayment';
    import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

    const props = defineProps({listing:Object})
    const {mothlyPayment} = useMonthlPayment(props.listing.price,2.5,25)
    const user = computed(()=>usePage().props.user) 
</script>