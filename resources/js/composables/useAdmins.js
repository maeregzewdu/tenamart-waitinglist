// src/composables/useAdmins.js
import { ref, onMounted } from "vue";
import axios from "axios";

const admins = ref([]);
const totalAdmins = ref(0);

const fetchAdmins = async () => {
    try {
        const res = await axios.get("http://localhost:8000/admins");
        totalAdmins.value = res.data.total_admins;
        admins.value = res.data.admins;
    } catch (error) {
        console.error("Error fetching admins:", error);
    }
};

export function useAdmins() {
    onMounted(() => {
        if (admins.value.length === 0) {
            fetchAdmins();
        }
    });

    return {
        admins,
        totalAdmins,
        fetchAdmins,
    };
}
