import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Sidebar from './components/Sidebar.vue';
import SidebarItem from './components/SidebarItem.vue';
import Dashboard from './components/Dashboard.vue';

// Initialize Vue app
const app = createApp({});

// Configure router
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/dashboard', component: Dashboard },
        // Add other routes later
    ]
});

// Register components
app.component('sidebar', Sidebar);
app.component('sidebar-item', SidebarItem);

// Use router
app.use(router);

// Mount the app
app.mount('#app');