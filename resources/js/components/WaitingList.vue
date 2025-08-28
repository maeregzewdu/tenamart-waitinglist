<template>
    <div class="waiting-list-container" @click="closeAllDropdowns">
        <!-- Top Control Bar - Fixed Position -->
        <div class="top-control-bar">
            <div class="left-controls">
                <div class="search-bar" @click.stop>
                    <i class="ri-search-line"></i>
                    <input
                        type="text"
                        placeholder="Search by name, email or phone..."
                        v-model="searchQuery"
                        @input="filterUsers"
                    />
                </div>
            </div>

            <div class="right-controls">
                <div class="source-filter" @click.stop="toggleSourceDropdown">
                    <span>{{ selectedSource || "Source" }}</span>
                    <i class="ri-arrow-down-s-line"></i>
                    <div class="source-dropdown" v-if="showSourceDropdown">
                        <div @click="filterBySource('')">All Sources</div>
                        <div
                            v-for="source in sources"
                            :key="source"
                            @click="filterBySource(source)"
                        >
                            {{ source }}
                        </div>
                    </div>
                </div>

                <div class="time-filter" @click.stop>
                    <i class="ri-calendar-line"></i>
                    <span
                        v-for="days in [1, 3, 7, 30]"
                        :key="days"
                        :class="{ active: selectedDays === days }"
                        @click="filterByDays(days)"
                    >
                        {{ days }}d
                    </span>
                    <span
                        :class="{ active: selectedDays === null }"
                        @click="filterByDays(null)"
                    >
                        All
                    </span>
                </div>

                <div class="filter-btn" @click.stop="toggleTimeframeDropdown">
                    <i class="ri-filter-line"></i>
                    <span>Filter</span>
                    <i class="ri-arrow-down-s-line"></i>
                    <div
                        class="timeframe-dropdown"
                        v-if="showTimeframeDropdown"
                    >
                        <div
                            v-for="timeframe in timeframes"
                            :key="timeframe.value"
                            :class="{
                                'bold-item': timeframe.value === 'today',
                                active: selectedTimeframe === timeframe.value,
                            }"
                            @click="applyTimeframeFilter(timeframe.value)"
                        >
                            {{ timeframe.label }}
                        </div>
                    </div>
                </div>

                <button class="download-btn" @click="downloadReport">
                    <i class="ri-download-line"></i>
                    <span>Download Excel</span>
                </button>
            </div>
        </div>

        <!-- Stats Card -->
        <div class="stats-card">
            <div class="icon-container">
                <i class="ri-file-list-3-line"></i>
            </div>
            <div class="stats-text">
                <div class="stat-title">Total waiting list</div>
                <div class="stat-value">{{ filteredUsers.length }}</div>
            </div>
        </div>

        <!-- Horizontal Divider -->
        <div class="horizontal-divider"></div>

        <!-- Loading Indicator -->
        <div v-if="loading" class="loading-overlay">
            <div class="loading-spinner"></div>
        </div>

        <!-- User Grid -->
        <div class="user-grid">
            <div
                class="user-card"
                v-for="(user, index) in paginatedUsers"
                :key="user.id"
            >
                <div
                    class="user-avatar"
                    :style="{ backgroundColor: getRandomColor() }"
                >
                    {{ user.name.charAt(0).toUpperCase() }}
                </div>
                <div class="user-info">
                    <h3>{{ user.name }}</h3>
                    <a :href="'mailto:' + user.email" class="user-email">{{
                        user.email
                    }}</a>
                    <div class="user-source">{{ user.source }}</div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button
                        class="action-btn view"
                        @click.stop="openViewModal(user)"
                    >
                        <i class="ri-eye-line"></i>
                        <span>View</span>
                    </button>
                    <button
                        class="action-btn edit"
                        @click.stop="openEditModal(user)"
                    >
                        <i class="ri-edit-line"></i>
                        <span>Edit</span>
                    </button>
                    <button
                        class="action-btn delete"
                        @click.stop="openDeleteModal(user)"
                    >
                        <i class="ri-delete-bin-line"></i>
                        <span>Delete</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-bar">
            <div class="page-info">
                Showing {{ currentPage }} of {{ totalPages }} pages ({{
                    filteredUsers.length
                }}
                users)
            </div>
            <div class="page-controls">
                <button
                    class="page-nav"
                    @click="prevPage"
                    :disabled="currentPage === 1"
                >
                    <i class="ri-arrow-left-s-line"></i>
                </button>
                <button
                    v-for="page in visiblePages"
                    :key="page"
                    class="page-number"
                    :class="{ active: currentPage === page }"
                    @click="goToPage(page)"
                >
                    {{ page }}
                </button>
                <button
                    class="page-nav"
                    @click="nextPage"
                    :disabled="currentPage === totalPages"
                >
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>
        </div>

        <!-- View Modal -->
        <div
            class="modal-overlay"
            v-if="viewModalVisible"
            @click.self="closeViewModal"
        >
            <div class="modal-content-view">
                <div class="modal-header">
                    <div class="header-icon-container">
                        <i class="ri-user-line"></i>
                    </div>
                    <div class="header-text">
                        <h2>View entry details</h2>
                        <p class="modal-subtitle">
                            view all the details of this entry
                        </p>
                    </div>
                    <button class="close-btn" @click="closeViewModal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="divider"></div>
                <div class="modal-body">
                    <div class="detail-row">
                        <div class="detail-column">
                            <div class="detail-item">
                                <span class="detail-label">Name</span>
                                <span class="detail-value">{{
                                    selectedUser.name
                                }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone number</span>
                                <span class="detail-value">{{
                                    selectedUser.phone || "N/A"
                                }}</span>
                            </div>
                        </div>
                        <div class="detail-column">
                            <div class="detail-item">
                                <span class="detail-label">Sign up source</span>
                                <span class="detail-value">{{
                                    selectedUser.source
                                }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label"
                                    >Registered date & time</span
                                >
                                <span class="detail-value"
                                    >{{ formatDate(selectedUser.joinDate) }} at
                                    {{
                                        formatTime(selectedUser.joinDate)
                                    }}</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button
                            class="action-btn edit"
                            @click.stop="editFromViewModal"
                        >
                            <i class="ri-edit-line"></i>
                            <span>Edit</span>
                        </button>
                        <button
                            class="action-btn delete"
                            @click.stop="deleteFromViewModal"
                        >
                            <i class="ri-delete-bin-line"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div
            class="modal-overlay"
            v-if="editModalVisible"
            @click.self="closeEditModal"
        >
            <div class="modal-content-edit">
                <div class="modal-header">
                    <div class="header-icon-container">
                        <i class="ri-user-settings-line"></i>
                    </div>
                    <div class="header-text">
                        <h2>Edit wait list entry</h2>
                        <p class="modal-subtitle">edit wait list entry</p>
                    </div>
                    <button class="close-btn" @click="closeEditModal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="divider"></div>
                <div class="modal-body">
                    <div class="edit-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" v-model="selectedUser.name" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" v-model="selectedUser.email" />
                        </div>
                        <div class="form-group">
                            <label>Phone number</label>
                            <input type="tel" v-model="selectedUser.phone" />
                        </div>
                        <div class="form-group">
                            <label>Sign up source</label>
                            <select v-model="selectedUser.source">
                                <option
                                    v-for="source in sources"
                                    :value="source"
                                >
                                    {{ source }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="modal-btn save-btn"
                            @click="saveUserChanges"
                        >
                            <i class="ri-save-line"></i>
                            <span>Save changes</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div
            class="modal-overlay"
            v-if="deleteModalVisible"
            @click.self="closeDeleteModal"
        >
            <div class="modal-content-delete">
                <div class="modal-header">
                    <div class="header-icon-container warning-icon">
                        <i class="ri-alert-line"></i>
                    </div>
                    <div class="header-text">
                        <h2>Delete Entry</h2>
                    </div>
                    <button class="close-btn" @click="closeDeleteModal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="warning-message">
                        Are you sure you want to delete this entry? This action
                        cannot be undone and will permanently remove all entry
                        data.
                    </p>
                    <div class="modal-footer">
                        <button
                            class="modal-btn cancel-btn"
                            @click="closeDeleteModal"
                        >
                            Cancel
                        </button>
                        <button
                            class="modal-btn delete-btn"
                            @click="confirmDelete"
                        >
                            <i class="ri-delete-bin-line"></i>
                            <span>Delete Entry</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { saveAs } from "file-saver";
import * as XLSX from "xlsx";

export default {
    name: "WaitingList",
    data() {
        return {
            searchQuery: "",
            selectedSource: "",
            selectedDays: null,
            selectedTimeframe: null,
            timeframes: [
                { value: "today", label: "Today" },
                { value: "3days", label: "Last 3 days" },
                { value: "7days", label: "Last 7 days" },
                { value: "30days", label: "Last 30 days" },
                { value: "all", label: "All time" },
            ],
            showTimeframeDropdown: false,
            statusFilter: "",
            showSourceDropdown: false,
            currentPage: 1,
            usersPerPage: 10,
            allUsers: [],
            filteredUsers: [],
            sources: [
                "facebook",
                "linkedIn",
                "Youtube",
                "instagram",
                "telegram",
                "Organic",
            ],
            viewModalVisible: false,
            editModalVisible: false,
            deleteModalVisible: false,
            selectedUser: {
                id: "",
                name: "",
                email: "",
                source: "",
                phone: "",
                pharmacy: "",
                joinDate: null,
                updatedAt: null,
            },
            totalItems: 0,
            perPage: 10,
            loading: false,
            serverSidePagination: {
                current_page: 1,
                last_page: 1,
                total: 0,
            },
        };
    },
    created() {
        this.fetchAllUsers();
        document.addEventListener("click", this.handleOutsideClick);
    },
    beforeDestroy() {
        document.removeEventListener("click", this.handleOutsideClick);
    },
    computed: {
        paginatedUsers() {
            const start = (this.currentPage - 1) * this.usersPerPage;
            const end = start + this.usersPerPage;
            return this.filteredUsers.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.filteredUsers.length / this.usersPerPage);
        },
        visiblePages() {
            const maxVisible = 5;
            const half = Math.floor(maxVisible / 2);
            let start = Math.max(1, this.currentPage - half);
            let end = Math.min(this.totalPages, start + maxVisible - 1);

            if (end - start + 1 < maxVisible) {
                start = Math.max(1, end - maxVisible + 1);
            }

            const pages = [];
            for (let i = start; i <= end; i++) {
                pages.push(i);
            }
            return pages;
        },
    },
    methods: {
        async fetchAllUsers() {
            this.loading = true;
            try {
                const initialResponse = await fetch("/waiting-list?page=1");
                const initialData = await initialResponse.json();

                const totalUsers = initialData.waiting_list.total;
                const perPage = initialData.waiting_list.per_page;
                const totalPages = initialData.waiting_list.last_page;

                // Fetch all pages concurrently
                const pagePromises = [];
                for (let page = 1; page <= totalPages; page++) {
                    pagePromises.push(fetch(`/waiting-list?page=${page}`));
                }

                // Wait for all requests to complete
                const responses = await Promise.all(pagePromises);
                const dataPromises = responses.map((response) =>
                    response.json()
                );
                const allData = await Promise.all(dataPromises);

                // Combine all users from all pages
                this.allUsers = allData.flatMap((data) =>
                    data.waiting_list.data.map((user) => ({
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        source: user.signup_source,
                        phone: user.phone,
                        pharmacy: user.pharmacy,
                        joinDate: new Date(user.created_at),
                        updatedAt: new Date(user.updated_at),
                    }))
                );

                this.filteredUsers = [...this.allUsers];
                this.totalItems = this.allUsers.length;

                // Store server-side pagination info
                this.serverSidePagination = {
                    current_page: 1,
                    last_page: totalPages,
                    total: totalUsers,
                };

                this.currentPage = 1; // Reset to first page after fetching all data

                console.log(
                    `Fetched ${this.allUsers.length} users from ${totalPages} pages`
                );
            } catch (error) {
                console.error("Error fetching all users:", error);
                // Fallback to single page fetch if bulk fetch fails
                this.fetchWaitingList(1);
            } finally {
                this.loading = false;
            }
        },

        async fetchWaitingList(page = 1) {
            this.loading = true;
            try {
                const response = await fetch(`/waiting-list?page=${page}`);
                const data = await response.json();

                // Store all users in a single array for client-side pagination
                this.allUsers = data.waiting_list.data.map((user) => ({
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    source: user.signup_source,
                    phone: user.phone,
                    pharmacy: user.pharmacy,
                    joinDate: new Date(user.created_at),
                    updatedAt: new Date(user.updated_at),
                }));

                this.filteredUsers = [...this.allUsers];
                this.totalItems = data.waiting_list.total;
                this.perPage = data.waiting_list.per_page;

                // Store server-side pagination info
                this.serverSidePagination = {
                    current_page: data.waiting_list.current_page,
                    last_page: data.waiting_list.last_page,
                    total: data.waiting_list.total,
                };

                this.currentPage = 1; // Reset to first page after fetching new data
            } catch (error) {
                console.error("Error fetching waiting list:", error);
            } finally {
                this.loading = false;
            }
        },

        filterUsers() {
            this.filteredUsers = this.allUsers.filter((user) => {
                const matchesSearch =
                    this.searchQuery === "" ||
                    user.name
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase()) ||
                    user.email
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase()) ||
                    (user.phone && user.phone.includes(this.searchQuery));

                const matchesSource =
                    this.selectedSource === "" ||
                    user.source === this.selectedSource;

                const matchesDays =
                    this.selectedDays === null ||
                    this.daysBetween(user.joinDate, new Date()) <=
                        this.selectedDays;

                const matchesTimeframe =
                    this.selectedTimeframe === null ||
                    this.matchesTimeframe(
                        user.joinDate,
                        this.selectedTimeframe
                    );

                const matchesStatus =
                    this.statusFilter === "" ||
                    user.status === this.statusFilter;

                return (
                    matchesSearch &&
                    matchesSource &&
                    matchesDays &&
                    matchesTimeframe &&
                    matchesStatus
                );
            });

            this.currentPage = 1;
        },

        daysBetween(date1, date2) {
            const diffTime = Math.abs(date2 - date1);
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        },

        matchesTimeframe(date, timeframe) {
            const now = new Date();
            const userDate = new Date(date);
            const diffDays = Math.floor(
                (now - userDate) / (1000 * 60 * 60 * 24)
            );

            switch (timeframe) {
                case "today":
                    return userDate.toDateString() === now.toDateString();
                case "3days":
                    return diffDays <= 3;
                case "7days":
                    return diffDays <= 7;
                case "30days":
                    return diffDays <= 30;
                case "all":
                    return true;
                default:
                    return true;
            }
        },

        filterBySource(source) {
            this.selectedSource = source;
            this.showSourceDropdown = false;
            this.filterUsers();
        },

        filterByDays(days) {
            this.selectedDays = days;
            this.selectedTimeframe = null;
            this.filterUsers();
        },

        applyTimeframeFilter(timeframe) {
            this.selectedTimeframe = timeframe;
            this.selectedDays = null;
            this.showTimeframeDropdown = false;
            this.filterUsers();
        },

        toggleSourceDropdown() {
            this.showSourceDropdown = !this.showSourceDropdown;
            this.showTimeframeDropdown = false;
        },

        toggleTimeframeDropdown() {
            this.showTimeframeDropdown = !this.showTimeframeDropdown;
            this.showSourceDropdown = false;
        },

        async downloadReport() {
            try {
                this.loading = true;

                // Prepare data for Excel export from filteredUsers
                const excelData = this.filteredUsers.map((user) => ({
                    Name: user.name,
                    Email: user.email,
                    Phone: user.phone || "N/A",
                    Source: user.source,
                    "Join Date": this.formatDate(user.joinDate),
                    "Join Time": this.formatTime(user.joinDate),
                }));

                // Create workbook and worksheet
                const workbook = XLSX.utils.book_new();
                const worksheet = XLSX.utils.json_to_sheet(excelData);

                // Add worksheet to workbook
                XLSX.utils.book_append_sheet(
                    workbook,
                    worksheet,
                    "Waiting List"
                );

                // Generate Excel file and download
                const excelBuffer = XLSX.write(workbook, {
                    bookType: "xlsx",
                    type: "array",
                });
                const blob = new Blob([excelBuffer], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                });

                // Generate filename with current date
                const today = new Date();
                const dateString = today.toISOString().split("T")[0];
                saveAs(blob, `waiting-list-${dateString}.xlsx`);
            } catch (error) {
                console.error("Error exporting to Excel:", error);
                this.$toast.error(
                    "Failed to download report. Please try again."
                );
            } finally {
                this.loading = false;
            }
        },

        formatDate(date) {
            return date.toLocaleDateString("en-US", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        },

        formatTime(date) {
            return date.toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
            });
        },

        getRandomColor() {
            const colors = [
                "#10B982",
                "#3B82F6",
                "#EF4444",
                "#F59E0B",
                "#8B5CF6",
                "#EC4899",
                "#14B8A6",
                "#F97316",
            ];
            return colors[Math.floor(Math.random() * colors.length)];
        },

        openViewModal(user) {
            this.selectedUser = { ...user };
            this.viewModalVisible = true;
        },

        closeViewModal() {
            this.viewModalVisible = false;
        },

        editFromViewModal() {
            this.closeViewModal();
            this.openEditModal(this.selectedUser);
        },

        deleteFromViewModal() {
            this.closeViewModal();
            this.openDeleteModal(this.selectedUser);
        },

        openEditModal(user) {
            this.selectedUser = { ...user };
            this.editModalVisible = true;
        },

        closeEditModal() {
            this.editModalVisible = false;
        },

        openDeleteModal(user) {
            this.selectedUser = { ...user };
            this.deleteModalVisible = true;
        },

        closeDeleteModal() {
            this.deleteModalVisible = false;
        },

        async saveUserChanges() {
            try {
                this.loading = true;
                const response = await fetch(
                    `/waiting-list/${this.selectedUser.id}/edit`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,
                            Accept: "application/json",
                        },
                        body: JSON.stringify({
                            name: this.selectedUser.name,
                            email: this.selectedUser.email,
                            phone: this.selectedUser.phone,
                            pharmacy: this.selectedUser.pharmacy,
                            signup_source: this.selectedUser.source,
                        }),
                    }
                );

                const data = await response.json();

                if (response.ok) {
                    // Update the user in our local data
                    const index = this.allUsers.findIndex(
                        (u) => u.id === this.selectedUser.id
                    );
                    if (index !== -1) {
                        this.allUsers[index] = {
                            ...this.allUsers[index],
                            name: this.selectedUser.name,
                            email: this.selectedUser.email,
                            phone: this.selectedUser.phone,
                            source: this.selectedUser.source,
                            updatedAt: new Date(),
                        };

                        // Also update in filteredUsers if needed
                        const filteredIndex = this.filteredUsers.findIndex(
                            (u) => u.id === this.selectedUser.id
                        );
                        if (filteredIndex !== -1) {
                            this.filteredUsers[filteredIndex] =
                                this.allUsers[index];
                        }
                    }

                    this.$toast.success("User updated successfully");
                } else {
                    throw new Error(data.message || "Failed to update user");
                }
            } catch (error) {
                console.error("Error updating user:", error);
                this.$toast.error(error.message || "Error updating user");
            } finally {
                this.loading = false;
                this.closeEditModal();
            }
        },

        async confirmDelete() {
            try {
                this.loading = true;
                const response = await fetch(
                    `/waiting-list/${this.selectedUser.id}/delete`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,
                            Accept: "application/json",
                        },
                    }
                );

                if (response.ok) {
                    // Remove the user from our local data
                    this.allUsers = this.allUsers.filter(
                        (u) => u.id !== this.selectedUser.id
                    );
                    this.filteredUsers = this.filteredUsers.filter(
                        (u) => u.id !== this.selectedUser.id
                    );

                    this.$toast.success("User deleted successfully");

                    // Adjust pagination if needed
                    if (
                        this.paginatedUsers.length === 0 &&
                        this.currentPage > 1
                    ) {
                        this.currentPage--;
                    }
                } else {
                    const errorData = await response.json();
                    throw new Error(
                        errorData.message || "Failed to delete user"
                    );
                }
            } catch (error) {
                console.error("Error deleting user:", error);
                this.$toast.error(error.message || "Error deleting user");
            } finally {
                this.loading = false;
                this.closeDeleteModal();
            }
        },

        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        goToPage(page) {
            this.currentPage = page;
        },

        closeAllDropdowns() {
            this.showSourceDropdown = false;
            this.showTimeframeDropdown = false;
        },

        handleOutsideClick(event) {
            if (!this.$el.contains(event.target)) {
                this.closeAllDropdowns();
            }
        },
    },
};
</script>

<style scoped>
/* Base Container - No Scrolling */
.waiting-list-container {
    width: 100%;
    height: 100vh;
    padding: 1rem;
    background: #ffffff;
    font-family: "Raleway", sans-serif;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
}

/* Top Control Bar - Exactly Matched to Statistics Page */
.top-control-bar {
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    position: relative;
}

.left-controls {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.search-bar {
    width: 300px;
    height: 36px;
    background: #f8fafc;
    border-radius: 6px;
    display: flex;
    align-items: center;
    padding: 0 0.75rem;
}

.search-bar i {
    color: #64748b;
    font-size: 1rem;
    margin-right: 0.5rem;
}

.search-bar input {
    border: none;
    background: transparent;
    width: 100%;
    height: 100%;
    outline: none;
    font-size: 0.85rem;
}

.search-bar input::placeholder {
    color: #94a3b8;
}

.right-controls {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
}

.source-filter,
.filter-btn {
    display: flex;
    align-items: center;
    padding: 0 0.75rem;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.8rem;
    height: 36px;
    position: relative;
    user-select: none;
}

.source-filter i,
.filter-btn i {
    margin-left: 0.5rem;
    font-size: 1rem;
}

.source-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    width: 100%;
    z-index: 10;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.source-dropdown div {
    padding: 0.5rem 0.75rem;
    cursor: pointer;
}

.source-dropdown div:first-child {
    font-weight: bold;
    border-bottom: 1px solid #e2e8f0;
}

.source-dropdown div:hover {
    background: #f8fafc;
}

.time-filter {
    display: flex;
    align-items: center;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    height: 36px;
    overflow: hidden;
}

.time-filter i {
    padding: 0 0.5rem;
    color: #64748b;
    border-right: 1px solid #e2e8f0;
    height: 100%;
    display: flex;
    align-items: center;
    font-size: 1rem;
}

.time-filter span {
    padding: 0 0.75rem;
    font-size: 0.8rem;
    cursor: pointer;
    border-right: 1px solid #e2e8f0;
    height: 100%;
    display: flex;
    align-items: center;
}

.time-filter span:last-child {
    border-right: none;
}

.time-filter span.active {
    background: #10b982;
    color: white;
}

.filter-btn {
    position: relative;
}

.timeframe-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    width: 150px;
    z-index: 10;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.timeframe-dropdown div {
    padding: 0.5rem 0.75rem;
    cursor: pointer;
}

.timeframe-dropdown div:hover {
    background: #f8fafc;
}

.timeframe-dropdown div.active {
    background: #10b982;
    color: white;
}

.bold-item {
    font-weight: bold;
}

.download-btn {
    display: flex;
    align-items: center;
    padding: 0 0.75rem;
    background: #10b982;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.8rem;
    height: 36px;
    white-space: nowrap;
}

.download-btn i {
    margin-right: 0.5rem;
    font-size: 1rem;
}

.download-btn:hover {
    background: #0d9f6e;
}

/* Stats Card - Updated to match statistics page with tighter width */
.stats-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    margin-bottom: 1rem;
    width: fit-content;
    max-width: 280px;
}

.icon-container {
    width: 48px;
    height: 48px;
    background: #10b982;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-container i {
    font-size: 1.5rem;
    color: white;
}

.stats-text {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.stat-title {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 0.25rem;
    white-space: nowrap;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #000000;
}

/* Horizontal Divider */
.horizontal-divider {
    height: 1px;
    background: #e2e8f0;
    margin: 0.5rem 0 1rem 0;
    width: 100%;
}

/* Loading Overlay */
.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #10b982;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

/* User Grid - Updated to show 10 users in a 5x2 grid with reduced spacing */
.user-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 0rem 0.5rem;
    margin: 0 -12px;
    margin-bottom: 0.5rem;
    flex: 1;
    overflow: hidden;
    height: calc(100% - 200px);
    padding: 0.1rem 0;
    align-content: start;
}

.user-card:nth-child(-n + 5) {
    margin-top: 15px;
}

.user-card:nth-child(n + 6) {
    margin-top: -50px;
    position: relative;
    top: -10px;
}

.user-card {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.8rem;
    display: flex;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    position: relative;
    height: 160px;
    overflow: hidden;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 16px;
    margin-right: 0.7rem;
    flex-shrink: 0;
    margin-top: 0.2rem;
}

.user-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-width: 0;
    overflow: hidden;
    top: 25px;
}

.user-info h3 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #000000;
    margin-bottom: 0.35rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-email {
    display: block;
    font-size: 0.8rem;
    color: #000000;
    text-decoration: none;
    margin-bottom: 0.35rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-email:hover {
    text-decoration: underline;
}

.user-source {
    font-size: 0.8rem;
    color: #10b982;
    font-style: italic;
    margin-bottom: 0.35rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-date {
    font-size: 0.75rem;
    color: #64748b;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Action Buttons*/
.action-buttons {
    position: absolute;
    left: 0.8rem;
    bottom: 0.8rem;
    display: flex;
    gap: 0.5rem;
    top: 115px;
}

.action-btn {
    padding: 0.4rem 0.6rem;
    border: none;
    border-radius: 4px;
    font-size: 0.75rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    gap: 0.3rem;
    min-width: auto;
    height: 28px;
}

.action-btn i {
    font-size: 0.85rem;
}

.action-btn.view {
    background: #e2e8f0;
    color: #1f2937;
}

.action-btn.edit {
    background: #10b982;
    color: white;
}

.action-btn.delete {
    background: #ef4444;
    color: white;
}

.action-btn:hover {
    opacity: 0.9;
}

/* Pagination - Compact Footer Style with 40px bottom (30px higher than before) */
.pagination-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-top: 1px solid #e2e8f0;
    margin-top: auto;
    position: absolute;
    bottom: 40px;
    left: 1rem;
    right: 1rem;
}

.page-info {
    color: #64748b;
    font-size: 0.85rem;
}

.page-controls {
    display: flex;
    gap: 0.4rem;
}

.page-nav,
.page-number {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e2e8f0;
    border-radius: 5px;
    background: #ffffff;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s;
}

.page-nav:hover:not(:disabled),
.page-number:hover:not(.active) {
    background: #f8fafc;
}

.page-nav:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.page-number.active {
    background: #10b982;
    color: white;
    border-color: #10b982;
}

.page-nav i {
    font-size: 1rem;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content-view,
.modal-content-edit,
.modal-content-delete {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.modal-header {
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
}

.header-icon-container {
    width: 50px;
    height: 50px;
    background: #10b982;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.header-icon-container.warning-icon {
    background: #ef4444;
}

.header-icon-container i {
    font-size: 1.8rem;
    color: white;
}

.header-text {
    flex: 1;
    min-width: 0;
}

.modal-header h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.close-btn {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 30px;
    height: 30px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 1.2rem;
    border-radius: 50%;
}

.close-btn:hover {
    background: #f1f5f9;
}

.divider {
    height: 1px;
    background: #e2e8f0;
    margin: 0 1.5rem;
}

.modal-body {
    padding: 1.5rem;
}

.detail-row {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.detail-column {
    flex: 1;
    min-width: 0;
}

.detail-item {
    margin-bottom: 1rem;
}

.detail-label {
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.25rem;
    display: block;
}

.detail-value {
    font-size: 1rem;
    font-weight: 500;
    color: #1f2937;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    padding-top: 1rem;
    border-top: 1px solid #e2e8f0;
}

.modal-actions .action-btn {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

/* Edit Modal Specific Styles */
.modal-content-edit .header-icon-container {
    background: #10b982;
}

.edit-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 0;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #4b5563;
    font-size: 0.875rem;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 0.9rem;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #10b982;
}

.modal-footer {
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid #e2e8f0;
}

.modal-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.save-btn {
    background: #10b982;
    color: white;
}

.save-btn:hover {
    background: #0d9f6e;
}

.cancel-btn {
    background: #e5e7eb;
    color: #4b5563;
}

.cancel-btn:hover {
    background: #d1d5db;
}

.delete-btn {
    background: #ef4444;
    color: white;
}

.delete-btn:hover {
    background: #dc2626;
}

/* Delete Modal Specific Styles */
.warning-message {
    color: #ef4444;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
    line-height: 1.5;
}

.modal-content-delete .modal-body {
    padding-top: 0;
}

.modal-content-delete .modal-footer {
    border-top: none;
    padding-top: 0;
    justify-content: flex-end;
    gap: 0.75rem;
}
</style>
