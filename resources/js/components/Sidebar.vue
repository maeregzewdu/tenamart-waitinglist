<script setup>
import SidebarItem from "./SidebarItem.vue";
import logo from "@images/logo-teal.png";
</script>

<template>
    <aside class="sidebar">
        <!-- Logo Section -->
        <div
            class="logo-section cursor-pointer"
            @click="$emit('toggle-section', 'general')"
        >
            <img :src="logo" alt="TENAMART" class="logo" />
        </div>

        <!-- Main Navigation -->
        <nav class="main-nav">
            <ul>
                <sidebar-item
                    icon="ri-dashboard-line"
                    title="General"
                    :active="activeSection === 'general'"
                    @click="$emit('toggle-section', 'general')"
                ></sidebar-item>
                <sidebar-item
                    icon="ri-bar-chart-line"
                    title="Statistics"
                    :active="activeSection === 'statistics'"
                    @click="$emit('toggle-section', 'statistics')"
                ></sidebar-item>
                <sidebar-item
                    icon="ri-list-check"
                    title="Waiting list"
                    :active="activeSection === 'waitingList'"
                    @click="$emit('toggle-section', 'waitingList')"
                ></sidebar-item>
                <sidebar-item
                    icon="ri-user-settings-line"
                    title="Admins"
                    :active="activeSection === 'admins'"
                    @click="$emit('toggle-section', 'admins')"
                ></sidebar-item>
                <sidebar-item
                    icon="ri-settings-3-line"
                    title="Profile settings"
                    :active="activeSection === 'profileSettings'"
                    @click="$emit('toggle-section', 'profileSettings')"
                ></sidebar-item>
            </ul>
        </nav>
    </aside>
</template>

<script>
export default {
    components: {
        SidebarItem,
    },
    props: {
        activeSection: {
            type: String,
            default: "general",
        },
    },
};
</script>

<style scoped>
.sidebar {
    position: absolute;
    width: 240px;
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #e5e5e5;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
}

.logo-section {
    padding: 0 20px 20px 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #e5e5e5;
}

.logo {
    height: 40px;
    display: block;
    margin-left: auto;
}

.main-nav {
    padding: 0 10px;
    flex-grow: 1;
}

.main-nav ul {
    padding: 0;
    margin: 0;
}
</style>
