<template>
    <!-- Top Bar -->
    <div class="flex items-center justify-end gap-4 mb-6">
        <!-- Search Bar -->
        <div class="relative w-60">
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
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search..."
                class="w-full h-10 pl-10 border border-gray-300 rounded-md focus:ring-2 focus:ring-tena-green focus:outline-none"
            />
        </div>

        <!-- Create Admin Button -->
        <button
            @click="showAdminModal = true"
            class="flex items-center gap-2 h-10 px-4 rounded-md bg-tena-green text-white font-semibold text-sm hover:opacity-90 transition"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <span>Create Admin</span>
        </button>
    </div>

    <!-- Stats -->
    <div
        class="bg-white w-[314px] h-[130px] rounded-[10px] transition-transform duration-300 hover:scale-105 border border-[#E5E5E5] flex items-center mb-2"
    >
        <div
            class="bg-tena-green w-[65px] h-[65px] rounded-md ml-[20px] flex items-center justify-center"
        >
            <!-- Increase icon size using text-[size] instead of w/h -->
            <i class="ri-admin-line text-white text-[32px]"></i>
        </div>
        <div class="ml-4 flex-1">
            <h3 class="text-sm font-medium text-gray-500">Total Admins</h3>
            <p class="text-2xl font-semibold text-gray-900">
                {{ filteredAdmins.length }}
            </p>
            <p v-if="searchQuery" class="text-xs text-gray-500">
                Showing {{ filteredAdmins.length }}
            </p>
        </div>
    </div>

    <!-- Admin Cards -->
    <hr class="mb-2 border border-[#E5E5E5] mr-[20px]" />
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 pb-2">
        <div
            v-for="admin in paginatedAdmins"
            :key="admin.id"
            class="w-full rounded-[10px] border border-[#E5E5E5] p-4"
        >
            <!-- Avatar and Info -->
            <div class="flex items-center gap-4">
                <div
                    class="w-[62px] h-[62px] rounded-full bg-tena-green flex items-center justify-center text-white font-bold text-xl"
                >
                    {{ admin.name.charAt(0).toUpperCase() }}
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        {{ admin.name }}
                    </h2>
                    <p class="text-sm text-gray-500">{{ admin.email }}</p>
                </div>
            </div>

            <!-- Buttons - Modified for full width responsiveness -->
            <div class="mt-4 flex flex-col sm:flex-row gap-2">
                <button
                    @click="openEditModal(admin)"
                    class="w-full sm:flex-1 h-[40px] bg-tena-green text-white rounded-md inline-flex items-center justify-center gap-2 hover:opacity-90 transition"
                >
                    <i class="ri-pencil-line text-white w-[18px] h-[18px]"></i>
                    <span class="text-sm font-semibold text-[13px]"
                        >Edit Admin</span
                    >
                </button>
                <button
                    @click="openDeleteModal(admin)"
                    class="w-full sm:flex-1 h-[40px] bg-red-500 text-white rounded-md inline-flex items-center justify-center hover:opacity-90 transition"
                >
                    <span class="text-sm font-semibold text-[13px]"
                        >Delete Admin</span
                    >
                </button>
            </div>
        </div>
    </div>
    <!-- Pagination Bar -->

    <!-- Edit Modal -->
    <div
        v-if="isEditing"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-md w-96">
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
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
    >
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-medium mb-4">Confirm Deletion</h3>
            <p class="mb-6">
                Are you sure you want to delete {{ userToDelete.name }}? This
                action cannot be undone.
            </p>
            <div class="flex justify-end space-x-3">
                <button
                    @click="showDeleteModal = false"
                    class="px-4 py-2 border rounded-md"
                >
                    Cancel
                </button>
                <button
                    @click="confirmDelete"
                    class="px-4 py-2 bg-red-600 text-white rounded-md"
                >
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Admin Modal -->
    <AdminModal
        :show="showAdminModal"
        @close="showAdminModal = false"
        @created="handleAdminCreated"
    />
</template>

<script setup>
import AdminModal from "@/components/AdminModal.vue";
import { ref, computed } from "vue";
import { useAdmins } from "@/composables/useAdmins";
import { watch } from "vue";

const showAdminModal = ref(false);
const searchQuery = ref("");
const isEditing = ref(false);
const editAdminData = ref({ id: null, name: "", email: "" });
const showDeleteModal = ref(false);
const userToDelete = ref({ id: null, name: "" });

const { admins, fetchAdmins, updateAdmin, deleteAdmin } = useAdmins();

const filteredAdmins = computed(() =>
    admins.value.filter(
        (admin) =>
            admin.name
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase()) ||
            admin.email.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);

const handleAdminCreated = async () => {
    await fetchAdmins();
};

// Edit
const openEditModal = (admin) => {
    editAdminData.value = { ...admin };
    isEditing.value = true;
};
const saveAdmin = async () => {
    const res = await updateAdmin(editAdminData.value.id, editAdminData.value);
    if (res.success) {
        await fetchAdmins();
        isEditing.value = false;
    } else {
        alert(res.message);
    }
};

// Delete
const openDeleteModal = (admin) => {
    userToDelete.value = { ...admin };
    showDeleteModal.value = true;
};
const confirmDelete = async () => {
    const res = await deleteAdmin(userToDelete.value.id);
    if (res.success) {
        await fetchAdmins();
        showDeleteModal.value = false;
    } else {
        alert(res.message);
    }
};

const currentPage = ref(1);
const perPage = 6; // number of admins per page

const totalPages = computed(() =>
    Math.ceil(filteredAdmins.value.length / perPage)
);

const paginatedAdmins = computed(() => {
    const start = (currentPage.value - 1) * perPage;
    return filteredAdmins.value.slice(start, start + perPage);
});

// limit visible page numbers (example: max 5 at a time)
const visiblePages = computed(() => {
    const maxVisible = 5;
    let start = Math.max(1, currentPage.value - Math.floor(maxVisible / 2));
    let end = start + maxVisible - 1;

    if (end > totalPages.value) {
        end = totalPages.value;
        start = Math.max(1, end - maxVisible + 1);
    }

    const pages = [];
    for (let i = start; i <= end; i++) {
        pages.push(i);
    }
    return pages;
});

const prevPage = () => {
    if (currentPage.value > 1) currentPage.value--;
};

const nextPage = () => {
    if (currentPage.value < totalPages.value) currentPage.value++;
};

const goToPage = (page) => {
    currentPage.value = page;
};
watch(filteredAdmins, () => {
    if (currentPage.value > totalPages.value) {
        currentPage.value = totalPages.value;
    }
    if (filteredAdmins.value.length === 0) {
        currentPage.value = 1;
    }
});
</script>

<style>
.bg-tena-green {
    background-color: #10b982; /* Tailwind green-600 */
}
</style>
