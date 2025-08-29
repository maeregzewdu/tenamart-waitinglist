<template>
    <div class="bg-white h-fit rounded-[10px] border border-[#E5E5E5] p-[20px]">
        <!-- Header -->
        <div class="relative flex items-center space-x-3">
            <div class="bg-tena-green w-[50px] h-[50px] rounded-lg flex items-center justify-center ">
                <i class="ri-cursor-line text-white text-[24px] relative"></i>
            </div>
            <div class="flex flex-col flex-1 relative">
                <h3 class="text-base font-semibold text-[24px] text-gray-800">
                    Recent Activities
                </h3>
                <p class="text-sm text-gray-500">
                    See all recent activities in this site
                </p>
            </div>
        </div>
        <hr class="my-5 text-neutral-200" />
        <ul class="space-y-3">
            <li
                v-for="activity in recentActivities"
                :key="activity.id"
                class="flex items-center bg-gray-50 rounded-md p-3 cursor-pointer"
            >
                <div class="flex-shrink-0">
                    <div class="p-2 rounded-md flex justify-center h-[40px] w-[40px] bg-tena-green">
                        <i class="ri-user-add-line text-white"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-semi-bold text-lg font-semibold text-gray-900">
                        {{ activity.name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Joined the waiting list {{ formatTime(activity.created_at) }}
                    </p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from "vue";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime);

const props = defineProps({
    data: {
        type: Array,
        required: false,
        default: () => []
    }
});

const recentActivities = props.data ?? [];

function formatTime(date) {
    return dayjs(date).fromNow();
}
</script>
