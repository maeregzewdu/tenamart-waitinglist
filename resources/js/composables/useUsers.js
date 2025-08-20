// src/composables/useUsers.js
import { ref, computed } from "vue";

// Function to generate mock users
const generateMockUsers = (count = 50) => {
    const firstNames = [
        "Abebe",
        "Chala",
        "Taye",
        "Toloso",
        "Girmay",
        "Eden",
        "Lema",
        "Wondimu",
        "Hanna",
    ];
    const lastNames = [
        "Hermon",
        "Ermias",
        "Elias",
        "Tesfaye",
        "Mulugeta",
        "Worku",
        "Tesfa",
        "Mangistu",
        "mantegbosh",
    ];
    const sources = [
        "Website",
        "Social Media",
        "Referral",
        "Advertisement",
        "Event",
    ];
    const statuses = ["active", "pending", "blocked"];

    const users = [];

    for (let i = 0; i < count; i++) {
        const firstName =
            firstNames[Math.floor(Math.random() * firstNames.length)];
        const lastName =
            lastNames[Math.floor(Math.random() * lastNames.length)];
        const daysAgo = Math.floor(Math.random() * 30);
        const signupDate = new Date();
        signupDate.setDate(signupDate.getDate() - daysAgo);

        users.push({
            id: `user-${i}`,
            name: `${firstName} ${lastName}`,
            email: `${firstName.toLowerCase()}.${lastName.toLowerCase()}@example.com`,
            signupDate: signupDate.toISOString(),
            source: sources[Math.floor(Math.random() * sources.length)],
            status: statuses[Math.floor(Math.random() * statuses.length)],
        });
    }

    return users;
};

// Main composable function
export function useUsers() {
    const loading = ref(true);
    const users = ref([]);
    const searchQuery = ref("");
    const sourceFilter = ref("");

    // Let us Fetch mock users (always 43)
    const fetchUsers = () => {
        loading.value = true;
        setTimeout(() => {
            users.value = generateMockUsers(43);
            loading.value = false;
        }, 800);
    };

    // Get unique sources
    const sources = computed(() => {
        const uniqueSources = new Set();
        users.value.forEach((user) => uniqueSources.add(user.source));
        return Array.from(uniqueSources).sort();
    });

    // Filtered and sorted users
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

    // Delete a user by ID
    const deleteUserById = (id) => {
        users.value = users.value.filter((user) => user.id !== id);
    };

    // Block a user by ID
    const blockUserById = (id) => {
        const user = users.value.find((user) => user.id === id);
        if (user) {
            user.status = "blocked";
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
        deleteUserById,
        blockUserById,
    };
}
