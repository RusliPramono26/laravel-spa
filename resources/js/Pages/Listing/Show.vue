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
            </Box>
        </div>
    </div>
</template>

<script setup>
import ListingAddres from '@/Component/ListingAddres.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/UI/Box.vue';
import { useMonthlPayment } from '@/Composables/useMonthlyPayment';
import { ref } from 'vue'; 

const interestRate = ref(2.5)
const duration = ref(25) 
const props =   defineProps({
        listing: Object,
    })

const {mothlyPayment} = useMonthlPayment(props.listing.price,interestRate,duration)
</script>