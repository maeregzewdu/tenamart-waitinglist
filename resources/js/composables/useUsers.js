import { ref, computed } from "vue";
import axios from "axios";

export function useUsers() {
    const loading = ref(true);
    const users = ref([]);
    const searchQuery = ref("");
    const sourceFilter = ref("");

    // ---------------- Fetch Users from Backend ----------------
    const fetchUsers = async () => {
        loading.value = true;
        try {
            const res = await axios.get(
                "http://localhost:8000/dashboard/waiting-list"
            );
            // Assuming API returns an array of users in res.data
            users.value = res.data;
        } catch (error) {
            console.error("❌ Failed to fetch users:", error);
            users.value = [];
        } finally {
            loading.value = false;
        }
    };

    // ---------------- Unique Sources ----------------
    const sources = computed(() => {
        const uniqueSources = new Set();
        users.value.forEach((user) => uniqueSources.add(user.source));
        return Array.from(uniqueSources).sort();
    });

    // ---------------- Filtered + Sorted Users ----------------
    const filteredUsers = computed(() => {
        return users.value
            .filter((user) => {
                const matchesSearch =
                    searchQuery.value === "" ||
                    user.name
                        .toLowerCase()
                        .includes(searchQuery.value.toLowerCase()) ||
                    user.email
                        .toLowerCase()
                        .includes(searchQuery.value.toLowerCase());

                const matchesSource =
                    sourceFilter.value === "" ||
                    user.source === sourceFilter.value;

                return matchesSearch && matchesSource;
            })
            .sort((a, b) => new Date(b.signupDate) - new Date(a.signupDate));
    });

    // ---------------- Delete User ----------------
    const deleteUserById = async (id) => {
        try {
            await axios.delete(
                `http://localhost:8000/dashboard/waiting-list/${id}`
            );
            users.value = users.value.filter((user) => user.id !== id);
        } catch (error) {
            console.error("❌ Failed to delete user:", error);
        }
    };

    // ---------------- Block User ----------------
    const blockUserById = async (id) => {
        try {
            const res = await axios.patch(
                `http://localhost:8000/dashboard/waiting-list/${id}/block`
            );
            const user = users.value.find((u) => u.id === id);
            if (user) {
                user.status = res.data.status || "blocked";
            }
        } catch (error) {
            console.error("❌ Failed to block user:", error);
        }
    };

    // Load initial data
    fetchUsers();

    return {
        users,
        loading,
        sources,
        filteredUsers,
        searchQuery,
        sourceFilter,
        fetchUsers,
        deleteUserById,
        blockUserById,
    };
}
