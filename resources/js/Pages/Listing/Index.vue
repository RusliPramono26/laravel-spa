<template>
    <div class="flex justify-between items-center gap-2 flex-wrap">
        <Filter :filters="filters"/>
       <Link
            v-if="user?.is_admin"
            :href="route('realtor.listing.create')"
            class="btn-primary flex items-center gap-1 whitespace-nowrap mb-4"
            >
            <span class="text-lg font-bold">+ New Listing</span>
        </Link>
    </div>  
    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing"/>
    </div>
    
    <div
        v-if="listings?.data?.length"
        class="w-full flex justify-center mt-8 mb-8"
        >
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import Pagination from '@/Component/UI/Pagination.vue';
import Listing from '@/Pages/Listing/Index/Component/Listing.vue';
import Filter from '@/Pages/Listing/Index/Component/Filter.vue';
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
defineProps({
    listings: Object,
    filters: Object
})
const page = usePage()
const user = computed(()=> page.props.user)
console.log(user.value)
</script>
