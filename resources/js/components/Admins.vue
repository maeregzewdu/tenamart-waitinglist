<template>
    <!-- Top Bar -->
    <div class="flex items-center ml-[637px] mb-[24px]">
        <!-- Search Bar -->
        <div class="relative w-[241px]">
            <!-- Search Icon -->
            <span
                class="absolute inset-y-0 left-3 flex items-center text-gray-400"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z"
                    />
                </svg>
            </span>

            <!-- Input -->
            <input
                type="text"
                placeholder="Search..."
                class="w-full h-[40px] pl-10 pr-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-tena-green focus:border-transparent"
            />
        </div>

        <!-- Create Admin Button -->
        <div
            @click="showAdminModal = true"
            class="flex items-center justify-center w-[148px] h-[40px] bg-tena-green px-3 rounded-md cursor-pointer hover:opacity-90 transition space-x-[14px] ml-[20px]"
        >
            <!-- Icon -->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>

            <!-- Text -->
            <span
                class="text-sm font-semibold text-[14px] text-white whitespace-nowrap"
            >
                Create Admin
            </span>
        </div>
    </div>

    <!-- Stats -->
    <div
        class="bg-white w-[314px] h-[130px] rounded-[10px] border border-[#E5E5E5] flex items-center mb-8"
    >
        <div
            class="bg-tena-green w-[65px] h-[65px] rounded-md ml-[20px] flex items-center justify-center"
        >
            <i class="ri-admin-line text-white w-[24px] h-[24px]"></i>
        </div>

        <div class="ml-4">
            <h3 class="text-sm font-medium text-gray-500">Total admins</h3>
            <p class="text-2xl font-semibold text-gray-900">
                {{ filteredAdmins.length }}
            </p>
        </div>
    </div>
    <!-- Admin Cards  -->
    <!-- Border of cards with height and width   -->
    <hr class="mb-5 border border-[#E5E5E5] mr-[20px]" />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-[25px]">
        <div
            v-for="admin in filteredAdmins"
            :key="admin.id"
            class="w-[314px] h-[150px] rounded-[10px] border border-[#E5E5E5]"
        >
            <!-- Avatar and Info Row -->
            <div class="flex items-center gap-[16px]">
                <!-- Avatar -->
                <div
                    class="w-[62px] h-[62px] rounded-full bg-tena-green flex items-center justify-center text-white font-bold text-xl mt-[16px] ml-[16px] mb-[16px]"
                >
                    {{ admin.name.charAt(0).toUpperCase() }}
                </div>

                <!-- Name & Email -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        {{ admin.name }}
                    </h2>
                    <p class="text-sm text-gray-500">{{ admin.email }}</p>
                </div>
            </div>

            <!-- Buttons Container with 16px spacing from card border -->
            <div class="flex space-x-[10px] ml-[16px]">
                <!-- Edit Admin Button (136x40px) -->
                <button
                    @click="openEditModal(admin)"
                    class="w-[136px] h-[40px] bg-tena-green text-white rounded-md inline-flex items-center justify-center space-x-[10px] hover:opacity-90 transition"
                >
                    <i
                        class="ri-pencil-line text-white w-[18px] h-[18px] mb-[10px]"
                    ></i>
                    <span class="text-sm font-semibold text-[13px]"
                        >Edit Admin</span
                    >
                </button>

                <!-- Delete Admin Button (136x40px) -->
                <button
                    @click="openDeleteModal(admin)"
                    class="w-[136px] h-[40px] bg-red-500 space-x-[10px] text-white rounded-md inline-flex items-center justify-center hover:opacity-90 transition"
                >
                    <TrashIcon class="w-[15px] h-[15px]" />
                    <span class="text-sm font-semibold text-[13px]"
                        >Delete Admin</span
                    >
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div
        v-if="isEditing"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-sm text-[12px] mb-4">Edit Admin</h2>
            <input
                v-model="editAdminData.name"
                type="text"
                placeholder="Name"
                class="w-full px-4 py-2 border rounded-md mb-3"
            />
            <input
                v-model="editAdminData.email"
                type="email"
                placeholder="Email"
                class="w-full px-4 py-2 border rounded-md mb-4"
            />
            <div class="flex justify-end space-x-3">
                <button
                    @click="isEditing = false"
                    class="px-4 py-2 border rounded-md"
                >
                    Cancel
                </button>
                <button
                    @click="saveAdmin"
                    class="bg-tena-green text-white px-4 py-2 rounded-md"
                >
                    Save
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div
        v-if="showDeleteModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
    >
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-medium mb-4">Confirm User Deletion</h3>
            <p class="mb-6">
                Are you sure you want to delete {{ userToDelete.name }}? This
                action cannot be undone.
            </p>
            <div class="flex justify-end space-x-3">
                <button
                    @click="showDeleteModal = false"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                >
                    Cancel
                </button>
                <button
                    @click="deleteUser"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>
    <AdminModal
        :show="showAdminModal"
        @close="showAdminModal = false"
        @created="handleAdminCreated"
    />
</template>

<script setup>
import AdminModal from "@/components/AdminModal.vue";
import { ref, onMounted, computed } from "vue";
import { TrashIcon } from "@heroicons/vue/24/solid";
import axios from "axios";

const showAdminModal = ref(false);
const searchQuery = ref("");

// State for admins
const admins = ref([]);
const totalAdmins = ref(0);

// Fetch admins from backend
const fetchAdmins = async () => {
    try {
        const res = await axios.get("http://localhost:8000/admins");
        totalAdmins.value = res.data.total_admins;
        admins.value = res.data.admins;
    } catch (error) {
        console.error("Error fetching admins:", error);
    }
};

onMounted(fetchAdmins);

// Search filter
const filteredAdmins = computed(() =>
    admins.value.filter(
        (admin) =>
            admin.name
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase()) ||
            admin.email.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);

// ---------------- Edit Logic ----------------
const isEditing = ref(false);
const editAdminData = ref({ id: null, name: "", email: "" });

const openEditModal = (admin) => {
    editAdminData.value = { ...admin };
    isEditing.value = true;
};

const saveAdmin = async () => {
    try {
        await axios.put(
            `http://localhost:8000/admins/${editAdminData.value.id}`,
            editAdminData.value
        );
        await fetchAdmins(); // refresh after update
        isEditing.value = false;
    } catch (error) {
        console.error("Error updating admin:", error);
    }
};

// ---------------- Delete Logic ----------------
const showDeleteModal = ref(false);
const userToDelete = ref({ id: null, name: "" });

const openDeleteModal = (admin) => {
    userToDelete.value = { ...admin };
    showDeleteModal.value = true;
};

const deleteUser = async () => {
    try {
        await axios.delete(
            `http://localhost:8000/admins/${userToDelete.value.id}`
        );
        await fetchAdmins(); // refresh after delete
        showDeleteModal.value = false;
    } catch (error) {
        console.error("Error deleting admin:", error);
    }
};
</script>

<style>
.bg-tena-green {
    background-color: tena-green;
}
</style>
