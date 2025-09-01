<template>
    <div
        class="bg-white hover:shadow-sm rounded-[10px] border border-[#E5E5E5] flex items-center p-6 transform transition-transform duration-300"
    >
        <div
            class="bg-tena-green w-[65px] h-[65px] flex items-center justify-center rounded-md"
        >
            <i :class="[icon, 'text-white', 'text-3xl']"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-sm font-medium text-gray-500">
                {{ title }}
            </h3>
            <p class="text-3xl font-bold text-gray-900">
                {{ data }}
            </p>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    data: {
        type: [String, Number],
        required: true
    },
    icon: {
        type: String,
        required: true
    }
})
</script>
