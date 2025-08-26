import { ref, onMounted } from "vue";
import axios from "axios";

const admins = ref([]);
const totalAdmins = ref(0);

// ---------------- Fetch all admins ----------------
const fetchAdmins = async () => {
    try {
        const res = await axios.get("http://localhost:8000/admins");
        totalAdmins.value = res.data.total_admins;
        admins.value = res.data.admins;
    } catch (error) {
        console.error("Error fetching admins:", error);
    }
};

// ---------------- Create new admin ----------------
const createAdmin = async (adminData) => {
    try {
        const res = await axios.post("http://localhost:8000/admins", adminData);

        admins.value.push(res.data.admin);
        totalAdmins.value = admins.value.length;

        return {
            success: true,
            data: res.data.admin,
            message: res.data.message,
        };
    } catch (error) {
        return {
            success: false,
            message: error.response?.data?.message || "Failed to create admin",
        };
    }
};

// ---------------- Update admin ----------------
const updateAdmin = async (id, adminData) => {
    try {
        const res = await axios.put(
            `http://localhost:8000/admins/${id}`,
            adminData
        );

        const index = admins.value.findIndex((a) => a.id === id);
        if (index !== -1) admins.value[index] = res.data.admin;

        return { success: true, data: res.data.admin };
    } catch (error) {
        return {
            success: false,
            message: error.response?.data?.message || "Failed to update admin",
        };
    }
};

// ---------------- Delete admin ----------------
const deleteAdmin = async (id) => {
    try {
        await axios.delete(`http://localhost:8000/admins/${id}`);

        admins.value = admins.value.filter((a) => a.id !== id);
        totalAdmins.value = admins.value.length;

        return { success: true };
    } catch (error) {
        return {
            success: false,
            message: error.response?.data?.message || "Failed to delete admin",
        };
    }
};

export function useAdmins() {
    onMounted(() => {
        if (admins.value.length === 0) fetchAdmins();
    });

    return {
        admins,
        totalAdmins,
        fetchAdmins,
        createAdmin,
        updateAdmin,
        deleteAdmin,
    };
}
