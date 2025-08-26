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
                <h3 class="text-base font-semibold text-gray-800 mt-[25px]">
                    Quick Actions
                </h3>
                <p class="text-sm text-gray-500">Short cut to common tasks</p>
            </div>
        </div>

        <hr class="mt-5 mb-5 border border-[#E5E5E5]" />

        <!-- Add Admin -->
        <div
            @click="showAdminModal = true"
            class="cursor-pointer bg-white p-2 rounded-[10px] ml-[36px] flex items-center space-x-4 hover:bg-gray-100 transition"
        >
            <!-- Square 24x24 purple button -->
            <div
                class="bg-tena-purple w-[24px] h-[24px] flex items-center justify-center rounded-md"
            >
                <i class="ri-add-line text-white text-[14px]"></i>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-900">Add Admin</h3>
            </div>
        </div>

        <!-- Create Wait List -->
        <div
            @click="showWaitModal = true"
            class="cursor-pointer bg-white p-2 rounded-[10px] ml-[36px] flex items-center space-x-4 hover:bg-gray-100 transition"
        >
            <!-- Square 24x24 icon button -->
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

        <!-- Styled Action Buttons -->
        <div class="grid grid-cols-1 gap-[6px] mt-4">
            <!-- Download List -->
            <div
                @click="exportWaitingList"
                class="cursor-pointer bg-white p-2 rounded-md ml-[36px] flex items-center space-x-4 hover:bg-gray-100 transition"
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
                class="cursor-pointer bg-white p-2 rounded-md ml-[36px] flex items-center space-x-4 hover:bg-gray-100 transition"
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

        <!-- Use the CreateWaitModal component (only one modal for waiting list) -->
        <CreateWaitModal
            :show="showWaitModal"
            @close="showWaitModal = false"
            @created="handleAdminCreated"
        />

        <!-- Admin modal -->
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
import CreateWaitModal from "./CreateWaitModal.vue"; // adjust path if needed
import { exportToCSV } from "@/utils/exportUtils";
import { useUsers } from "@/composables/useUsers";
import { useToast } from "vue-toastification";

const showWaitModal = ref(false);
const showAdminModal = ref(false);

// local list of newly created wait list items (optional)
const waitListUsers = ref([]);

const authStore = useAuthStore();
const { filteredUsers, fetchUsers } = useUsers();
const toast = useToast();

// ------------------ Waiting List helper ------------------
const addNewWaitUser = (user) => {
    // keep a local quick list (optional)
    waitListUsers.value.unshift(user);
};

// Export CSV
const exportWaitingList = () => {
    exportToCSV(filteredUsers.value, "tenamart_waiting_list", [
        "name",
        "email",
        "signupDate",
        "source",
        "status",
    ]);

    authStore.activities.unshift({
        icon: ArrowDownTrayIcon,
        iconBgColor: "bg-blue-500",
        description: "Waiting list exported to CSV",
        time: "Just now",
    });
    toast.success("Waiting list exported");
};

// Generate shareable link
const generateShareLink = () => {
    const link = `${window.location.origin}/join?ref=admin-${Date.now()}`;
    navigator.clipboard
        .writeText(link)
        .then(() => {
            authStore.activities.unshift({
                icon: LinkIcon,
                iconBgColor: "bg-purple-500",
                description: "New shareable link generated",
                time: "Just now",
            });
            toast.success("Shareable link copied to clipboard!");
        })
        .catch((err) => {
            console.error("clipboard error:", err);
            toast.error("Failed to copy link");
        });
};

// ------------------ Handlers for created / error ------------------
const handleAdminCreated = async (newEntity) => {
    // newEntity: payload emitted from the modal (created user/admin)
    if (newEntity) {
        addNewWaitUser(newEntity);
    }

    // refresh from backend to keep UI consistent
    if (typeof fetchUsers === "function") {
        try {
            await fetchUsers();
        } catch (err) {
            console.error("Failed to refresh users after create:", err);
        }
    }

    // push activity and notify
    authStore.activities.unshift({
        icon: UserPlusIcon,
        iconBgColor: "bg-green-500",
        description: `New entry added: ${
            newEntity?.email || newEntity?.name || "New user"
        }`,
        time: "Just now",
    });
};

const handleAdminError = (err) => {
    const message = err?.message || err || "An error occurred";
    toast.error(message);
};
</script>
