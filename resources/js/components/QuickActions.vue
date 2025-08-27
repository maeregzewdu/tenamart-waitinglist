<template>
    <div class="bg-white p-2 rounded-[10px] border border-[#E5E5E5] mb-8">
        <!-- Section Title -->
        <div class="relative flex items-center space-x-3">
            <!-- Green box with cursor icon -->
            <div
                class="bg-tena-green w-[50px] h-[50px] rounded-md ml-[20px] flex items-center mt-5 justify-center"
            >
                <i
                    class="ri-cursor-line text-white w-[24px] h-[24px] relative left-[2px]"
                ></i>
            </div>

            <!-- Title + Subtitle -->
            <div class="flex flex-col flex-1 relative">
                <!-- Last Seen (top right) -->

                <h3 class="text-base font-semibold text-gray-800 mt-[25px]">
                    Quick Actions
                </h3>
                <p class="text-sm text-gray-500">Short cut to common tasks</p>
            </div>
        </div>
        <hr class="mt-5 mb-5 border border-[#E5E5E5]" />
        <!-- Add Admin -->
        <div class="bg-white p-4 rounded-[10px] border border-[#E5E5E5]">
            <!-- Quick Action Buttons -->
            <div class="flex flex-col space-y-2">
                <!-- Add Admin -->
                <div
                    @click="showAdminModal = true"
                    class="cursor-pointer bg-white p-2 rounded-[10px] flex items-center space-x-4 hover:bg-gray-100 transition"
                >
                    <div
                        class="bg-tena-purple w-[24px] h-[24px] flex items-center justify-center rounded-md"
                    >
                        <i class="ri-add-line text-white text-[14px]"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">
                            Add Admin
                        </h3>
                    </div>
                </div>

                <!-- Create Waiting List -->
                <div
                    @click="showWaitModal = true"
                    class="cursor-pointer bg-white p-2 rounded-[10px] flex items-center space-x-4 hover:bg-gray-100 transition"
                >
                    <div
                        class="bg-tena-green w-[24px] h-[24px] flex items-center justify-center rounded-md"
                    >
                        <i class="ri-admin-line text-white text-[14px]"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">
                            Create Waiting List
                        </h3>
                    </div>
                </div>

                <!-- Download List -->
                <div
                    @click="exportWaitingList"
                    class="cursor-pointer bg-white p-2 rounded-[10px] flex items-center space-x-4 hover:bg-gray-100 transition"
                >
                    <div
                        class="bg-tena-green w-[24px] h-[24px] flex items-center justify-center rounded-md"
                    >
                        <i class="ri-download-line text-white text-[14px]"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">
                            Download List
                        </h3>
                    </div>
                </div>

                <!-- Generate Link -->
                <div
                    @click="generateShareLink"
                    class="cursor-pointer bg-white p-2 rounded-[10px] flex items-center space-x-4 hover:bg-gray-100 transition"
                >
                    <div
                        class="bg-tena-green w-[24px] h-[24px] flex items-center justify-center rounded-md"
                    >
                        <i class="ri-link text-white text-[14px]"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">
                            Generate Link
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <CreateWaitModal
                :show="showWaitModal"
                @close="showWaitModal = false"
                @created="handleAdminCreated"
            />
            <AdminModal
                :show="showAdminModal"
                @close="showAdminModal = false"
                @created="handleAdminCreated"
                @error="handleAdminError"
            />
        </div>

        <!-- Admin Modal "-->
        <!-- You can use v-if="showAdminModal exactly right below here <Admin modal -->
        <CreateWaitModal
            :show="showWaitModal"
            @close="showWaitModal = false"
            @created="handleAdminCreated"
        />

        <AdminModal
            :show="showAdminModal"
            @close="showAdminModal = false"
            @created="handleAdminCreated"
            @error="handleAdminError"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import {
    ArrowDownTrayIcon,
    LinkIcon,
    UserPlusIcon,
} from "@heroicons/vue/24/outline";
import AdminModal from "@/components/AdminModal.vue";
import { useUsers } from "@/composables/useUsers";
import { useToast } from "vue-toastification";
import axios from "axios";
import * as XLSX from "xlsx";
import { saveAs } from "file-saver";

import CreateWaitModal from "./CreateWaitModal.vue"; // adjust path

// Waiting list Scripts
const showWaitModal = ref(false);
const waitListUsers = ref([]); // Array to store new wait list users
const showAdminModal = ref(false);

const authStore = useAuthStore();
const { filteredUsers } = useUsers();
const toast = useToast();

// ------------------ Waiting List ------------------
const addNewWaitUser = (user) => {
    waitListUsers.value.push(user);
};

// Export waiting list from backend
const exportWaitingList = async () => {
    try {
        // Fetch first page to get total pages
        const firstRes = await axios.get(
            "http://localhost:8000/waiting-list?page=1"
        );
        const totalPages = firstRes.data.waiting_list.last_page || 1;

        let allUsers = firstRes.data.waiting_list.data;

        // Fetch remaining pages if any
        const promises = [];
        for (let page = 2; page <= totalPages; page++) {
            promises.push(
                axios.get(`http://localhost:8000/waiting-list?page=${page}`)
            );
        }

        const responses = await Promise.all(promises);
        responses.forEach((res) => {
            allUsers = allUsers.concat(res.data.waiting_list.data);
        });

        // Map users for Excel
        const excelData = allUsers.map((user) => ({
            Name: user.name,
            Email: user.email,
            SignupDate: new Date(user.created_at).toLocaleDateString(),
            Source: user.signup_source,
            Status: user.status || "Active",
        }));

        // Create workbook & worksheet
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(excelData);
        XLSX.utils.book_append_sheet(workbook, worksheet, "Waiting List");

        // Save as Excel file
        const excelBuffer = XLSX.write(workbook, {
            bookType: "xlsx",
            type: "array",
        });
        const blob = new Blob([excelBuffer], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        });
        saveAs(blob, `waiting-list.xlsx`);

        // Log activity
        authStore.activities.unshift({
            icon: ArrowDownTrayIcon,
            iconBgColor: "bg-blue-500",
            description: "Waiting list exported to Excel",
            time: "Just now",
        });

        toast.success("Waiting list downloaded successfully!");
    } catch (error) {
        console.error("Error downloading waiting list:", error);
        toast.error("Failed to download waiting list.");
    }
};

// ------------------ Share Link ------------------
const generateShareLink = () => {
    const link = `${window.location.origin}/join?ref=admin-${Date.now()}`;
    navigator.clipboard.writeText(link);

    authStore.activities.unshift({
        icon: LinkIcon,
        iconBgColor: "bg-purple-500",
        description: "New shareable link generated",
        time: "Just now",
    });

    toast.success("Shareable link copied to clipboard!");
};
</script>
