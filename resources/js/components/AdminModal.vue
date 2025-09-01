<template>
    <Transition
        enter-active-class="transition-opacity duration-300 ease"
        enter-from-class="opacity-0"
        leave-active-class="transition-opacity duration-300 ease"
        leave-to-class="opacity-0"
    >
        <div
            v-if="show"
            class="fixed inset-0 z-50 overflow-y-auto"
            @click.self="handleClose"
        >
            <div
                class="fixed inset-0 bg-black/60 transition-opacity"
                aria-hidden="true"
                @click.self="handleClose"
            ></div>

            <!-- Modal container -->
            <div
                class="flex items-center justify-center min-h-screen p-4 sm:p-0"
            >
                <!-- Modal content (stops click propagation) -->
                <div
                    class="relative bg-white rounded-lg shadow-xl transform transition-all w-full max-w-lg mx-auto my-8 overflow-hidden"
                    @click.stop
                    role="dialog"
                    aria-modal="true"
                >
                    <!-- Error message -->
                    <div
                        v-if="errorMessage"
                        class="mx-6 mt-4 p-3 bg-red-50 text-red-600 text-sm rounded-md"
                    >
                        {{ errorMessage }}
                    </div>

                    <!-- Form -->

                    <form
                        @submit.prevent="handleSubmit"
                        class="bg-white rounded-lg shadow overflow-hidden relative"
                    >
                        <!-- Close Button (X) -->
                        <button
                            type="button"
                            @click="handleClose"
                            class="absolute top-4 right-4 p-1 text-gray-400 hover:text-gray-500 focus:outline-none"
                            aria-label="Close"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>

                        <!-- Header Section -->
                        <div
                            class="px-6 pt-6 pb-4 border-b border-gray-200 flex items-start space-x-4"
                        >
                            <div
                                class="bg-tena-green rounded-md w-[50px] h-[50px] flex items-center justify-center"
                            >
                                <i
                                    class="ri-admin-line text-white text-[20px]"
                                ></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    Create Admin
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Add admin to this website
                                </p>
                            </div>
                        </div>

                        <!-- Form Fields -->
                        <div class="p-6 space-y-6">
                            <!-- Name and Email Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Full Name
                                    </label>
                                    <input
                                        v-model="name"
                                        type="text"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-tena-green focus:border-tena-green"
                                        :disabled="isSubmitting"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Email Address
                                    </label>
                                    <input
                                        v-model="email"
                                        type="email"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-tena-green focus:border-tena-green"
                                        :disabled="isSubmitting"
                                    />
                                </div>
                            </div>

                            <!-- Password and Confirm Password Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Password
                                    </label>
                                    <input
                                        v-model="password"
                                        type="password"
                                        required
                                        minlength="8"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-tena-green focus:border-tena-green"
                                        :disabled="isSubmitting"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-2"
                                    >
                                        Confirm Password
                                    </label>
                                    <input
                                        v-model="confirmPassword"
                                        type="password"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-tena-green focus:border-tena-green"
                                        :disabled="isSubmitting"
                                    />
                                    <p
                                        v-if="passwordMismatch"
                                        class="mt-1 text-xs text-red-600"
                                    >
                                        Passwords do not match!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div
                            class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3"
                        >
                            <button
                                type="button"
                                @click="handleClose"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-[6] shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tena-green"
                                :disabled="isSubmitting"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-tena-green border border-transparent rounded-md shadow-sm hover:bg-tena-green-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tena-green flex items-center justify-center space-x-2"
                                :disabled="isSubmitting || passwordMismatch"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-plus"
                                >
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                <span v-if="!isSubmitting">Create</span>
                                <span v-else>Creating...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref, computed } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";
import { useAdmins } from "@/composables/useAdmins";
const { createAdmin } = useAdmins();

const props = defineProps({
    show: Boolean,
});

const emit = defineEmits(["close", "created"]);

const toast = useToast();

// Form fields
const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");
const isSubmitting = ref(false);

// Password mismatch check
const passwordMismatch = computed(() => {
    return (
        password.value !== confirmPassword.value &&
        confirmPassword.value.length > 0
    );
});

// Close modal
const handleClose = () => {
    if (!isSubmitting.value) {
        resetForm();
        emit("close");
    }
};

// Reset form
const resetForm = () => {
    name.value = "";
    email.value = "";
    password.value = "";
    confirmPassword.value = "";
};
const handleSubmit = async () => {
    if (passwordMismatch.value) {
        toast.error("Passwords do not match!");
        return;
    }

    isSubmitting.value = true;

    const payload = {
        name: name.value.trim(),
        email: email.value.trim(),
        password: password.value,
    };

    try {
        const response = await axios.post(
            "http://localhost:8000/create-admin",
            payload
        );

        // Success toast here
        toast.success(response.data.message || "Admin created successfully!");

        // Emit to parent so list can refresh
        emit("created", response.data.admin);

        handleClose();
    } catch (error) {
        console.error("Admin creation error:", error);

        toast.error(error.response?.data?.message || "Failed to create admin");

        // Optional: emit failure to parent if you want
        // emit("error", error.response?.data?.message || "Failed to create admin");
    } finally {
        isSubmitting.value = false;
    }
};

// Submit form
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

/* Ensures modal content is always clickable */
[role="dialog"] {
    pointer-events: auto;
}
</style>
