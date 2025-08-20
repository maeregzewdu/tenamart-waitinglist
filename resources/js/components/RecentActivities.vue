<template>
    <div class="bg-white h-[450px] rounded-[10px] border border-[#E5E5E5] mb-8">
        <!-- Header -->

        <div class="relative flex items-center space-x-3 ml-[20px]">
            <!-- Green box with cursor icon -->
            <div
                class="bg-tena-green w-[50px] h-[50px] rounded-md flex items-center justify-center mt-[20px]"
            >
                <i
                    class="ri-cursor-line text-white w-[24px] h-[24px] relative left-[2px]"
                ></i>
            </div>

            <!-- Title + Subtitle -->
            <div class="flex flex-col flex-1 relative">
                <!-- Last Seen (top right) -->
                <span
                    class="absolute right-0 -top-4 text-xs text-gray-400 mt-[25px] mr-[20px]"
                >
                    Last 24 hrs
                </span>

                <h3 class="text-base font-semibold text-gray-800 mt-[25px]">
                    Recent Activities
                </h3>
                <p class="text-sm text-gray-500">
                    See all recent activities in this site
                </p>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-5 border border-[#E5E5E5] ml-[20px] mr-[20px]" />

        <!-- Activity List -->
        <ul class="mt-2 space-y-3">
            <li
                v-for="(activity, index) in activities"
                :key="index"
                class="flex items-start"
            >
                <div class="flex-shrink-0 ml-[36px]">
                    <div :class="`p-2 rounded-md ${activity.iconBgColor}`">
                        <component
                            :is="activity.icon"
                            class="h-5 w-5 text-white"
                        />
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">
                        {{ activity.description }}
                    </p>
                    <p class="text-sm text-gray-500">{{ activity.time }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from "vue";
import {
    ClockIcon,
    UserPlusIcon,
    ArrowDownTrayIcon as DownloadIcon,
    LinkIcon,
} from "@heroicons/vue/24/outline";

const activities = ref([
    {
        icon: UserPlusIcon,
        iconBgColor: "bg-tena-green",
        description: "5 new users joined waiting list",
        time: "2 minutes ago",
    },
    {
        icon: DownloadIcon,
        iconBgColor: "bg-tena-green",
        description: "Waiting list exported to CSV",
        time: "1 hour ago",
    },
    {
        icon: LinkIcon,
        iconBgColor: "bg-tena-green",
        description: "New shareable link generated",
        time: "3 hours ago",
    },
]);
</script>
