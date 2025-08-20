import { defineStore } from "pinia";
import { ref, computed } from "vue";

export const useAuthStore = defineStore("auth", () => {
    // State
    const user = ref(null);
    const isAuthenticated = ref(false);
    const admins = ref([]);
    const activities = ref([]); // Added activities array

    // Initialize store
    const loadInitialData = () => {
        const savedAdmins = localStorage.getItem("tenamart-admins");
        const savedActivities = localStorage.getItem("tenamart-activities");

        if (savedAdmins) admins.value = JSON.parse(savedAdmins);
        if (savedActivities) activities.value = JSON.parse(savedActivities);
    };

    // Actions
    const createAdmin = async ({ name, email, password }) => {
        try {
            // Validation
            if (!name?.trim()) throw new Error("Name is required");
            if (!email?.trim()) throw new Error("Email is required");
            if (!password) throw new Error("Password is required");
            if (password.length < 8)
                throw new Error("Password must be at least 8 characters");
            if (!/^\S+@\S+\.\S+$/.test(email))
                throw new Error("Invalid email format");

            // Check for duplicate email
            if (admins.value.some((admin) => admin.email === email)) {
                throw new Error("Email already exists");
            }

            const newAdmin = {
                id: Date.now(),
                name: name.trim(),
                email: email.trim(),
                password, // Note: In production, hash this password!
                role: "admin",
                createdAt: new Date().toISOString(),
            };

            // Update state
            admins.value.unshift(newAdmin);
            activities.value.unshift({
                type: "admin_created",
                email: newAdmin.email,
                timestamp: newAdmin.createdAt,
            });

            // Persist to localStorage
            localStorage.setItem(
                "tenamart-admins",
                JSON.stringify(admins.value)
            );
            localStorage.setItem(
                "tenamart-activities",
                JSON.stringify(activities.value)
            );

            return {
                success: true,
                message: "Admin created successfully",
                data: newAdmin,
            };
        } catch (error) {
            return {
                success: false,
                message: error.message,
                data: null,
            };
        }
    };

    const login = async (email, password) => {
        try {
            // Basic validation
            if (!email || !password) {
                throw new Error("Email and password are required");
            }

            // Mock authentication
            await new Promise((resolve) => setTimeout(resolve, 500));

            if (email === "admin@tenamart.com" && password === "password123") {
                user.value = { email, name: "Admin" };
                isAuthenticated.value = true;
                localStorage.setItem("tenamart-auth", "true");
                return true;
            }
            throw new Error("Invalid credentials");
        } catch (error) {
            console.error("Login failed:", error);
            throw error;
        }
    };

    const logout = () => {
        user.value = null;
        isAuthenticated.value = false;
        localStorage.removeItem("tenamart-auth");
    };

    const checkAuth = () => {
        isAuthenticated.value = !!localStorage.getItem("tenamart-auth");
    };

    // Initialize
    loadInitialData();

    // Getters
    const totalAdmins = computed(() => admins.value.length);
    const recentActivities = computed(() => activities.value.slice(0, 5));

    return {
        // State
        user,
        isAuthenticated,
        admins,
        activities,

        // Actions
        createAdmin,
        login,
        logout,
        checkAuth,

        // Getters
        totalAdmins,
        recentActivities,
    };
});
