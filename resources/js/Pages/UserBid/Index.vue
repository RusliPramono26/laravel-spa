<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>

  <section>
    <BidFilter :filters="filters" />
  </section>

  <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div :class="{ 'opacity-25': listing.deleted_at }">
          <div class="flex items-center gap-1 mb-2">
                <div
                    v-if="listing.sold_at == null"
                    class="text-xs font-bold uppercase border border-dashed p-1
                        border-gray-300 text-gray-500 dark:border-gray-600 dark:text-gray-600
                        rounded-md"
                >
                    On Review
                </div>
                <div
                    v-if="listing.sold_at"
                    class="text-xs font-bold uppercase border border-dashed p-1
                        border-green-300 text-green-500 dark:border-green-600 dark:text-green-600
                        rounded-md"
                >
                    Sold
                </div>
                <div
                    v-if="listing.sold_at && listing.sold_to === user"
                    class="text-xs font-bold uppercase border border-dashed p-1
                        border-green-300 text-green-500 dark:border-green-600 dark:text-green-600
                        rounded-md"
                >
                    Accepted
                </div>
                <div
                    v-else-if="listing.sold_at && listing.sold_to !== user"
                    class="text-xs font-bold uppercase border border-dashed p-1
                        border-red-300 text-red-500 dark:border-red-600 dark:text-red-600
                        rounded-md"
                >
                    Rejected
                </div>
            </div> 
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium" />
            <ListingSpace :listing="listing" />
          </div>
          <ListingAddres :listing="listing" />
        </div>
        <section>
          <div
            class="flex items-center gap-1 text-gray-600 dark:text-gray-300"
          >
            <a
              class="btn-outline text-xs font-medium"
              :href="route('listing.show', { listing: listing.id })"
              target="_blank"
            >Preview</a>
          </div>
        </section>
      </div>
    </Box>
  </section>
  <EmptyState v-else>No listings yet</EmptyState>

  <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="listings.links" />
  </section>
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue'
import ListingSpace from '@/Component/ListingSpace.vue'
import Price from '@/Component/Price.vue'
import Box from '@/Component/UI/Box.vue'
import Pagination from '@/Component/UI/Pagination.vue'
import { usePage } from '@inertiajs/vue3'
import RealtorFilter from '@/Pages/Realtor/Index/Component/RealtorFilter.vue'
import { computed } from 'vue'
import BidFilter from './Index/Components/BidFilter.vue'


defineProps({
  listings: Object,
  Offers: Object,
})

const page = usePage()
const user = computed(() => page.props.user?.id)
console.log(user.value)
</script>