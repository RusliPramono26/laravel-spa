<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-12">
        <Box v-if="listing.images.length"  class="md:col-span-7 flex items-center">
            <div class="grid grid-cols-2 gap-1">
                <img
                v-for="image in listing.images" :key="image.id"
                :src="image.src"
                />
            </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center">No images</EmptyState>
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
                <div>
                    <label class="label">Interest Rate({{interestRate}}%)</label>
                    <input v-model.number= "interestRate"
                    type="range" min="0.1" max="30" step="0.1" 
                    class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>

                    <label class="label">Duration ({{duration}} Year)</label>
                    <input 
                    v-model.number="duration"
                    type="range" min="1" max="35" step="1" 
                    class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>
                </div>

                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">
                        Your Monthly Payment
                    </div>
                    <Price :price="mothlyPayment" class="text-3xl"/>
                </div>

                <div class="mt-2 text-gray-800">
                    <div class="flex justify-between">
                        <div>Total Paid</div>
                        <Price :price="totalPaid" class="font-medium"/>
                    </div>
                    <div class="flex justify-between">
                        <div>Principal Paid</div>
                        <Price :price="listing.price" class="font-medium"/>
                    </div>
                    <div class="flex justify-between">
                        <div>Total Interest</div>
                        <Price :price="totalInterest" class="font-medium"/>
                    </div>
                    
                </div>
            </Box>

            <MakeOffer 
                v-if="user && !offerMade"
                :listing-id="listing.id"
                :price="listing.price" 
                @offer-updated="offer = $event"
            />

            <OfferMade v-if="user && offerMade" :offer="offerMade" />
        </div>
    </div>
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/UI/Box.vue';
import { useMonthlPayment } from '@/Composables/useMonthlyPayment';
import { computed, ref } from 'vue'; 
import MakeOffer from '@/Pages/Listing/Show/Componets/MakeOffer.vue';
import { usePage } from '@inertiajs/vue3';
import OfferMade from '@/Pages/Listing/Show/Componets/OfferMade.vue';
import EmptyState from '@/Component/UI/EmptyState.vue';

const interestRate = ref(2.5)
const duration = ref(25) 
const props =   defineProps({
        listing: Object,
        offerMade: Object,
    })

const offer = ref(props.listing.price)

const {mothlyPayment,totalPaid, totalInterest} = useMonthlPayment(offer,interestRate,duration)

const page = usePage()
const user = computed(
  () => page.props.user,
)
</script>