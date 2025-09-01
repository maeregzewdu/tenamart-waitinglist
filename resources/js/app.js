import "./bootstrap"
import { createApp } from "vue"
import { createRouter, createWebHistory } from "vue-router"
import { createPinia } from "pinia"
import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"

// Components
import Sidebar from "./components/Sidebar.vue"
import SidebarItem from "./components/SidebarItem.vue"
import Dashboard from "./components/Dashboard.vue"

// Create Vue app
const app = createApp(Dashboard)

// Create Pinia
const pinia = createPinia()

// Configure router
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/dashboard", component: Dashboard },
    // Add other routes later
  ],
})

// Register global components
app.component("sidebar", Sidebar)
app.component("sidebar-item", SidebarItem)

// Use plugins
app.use(router)
app.use(pinia)
app.use(Toast)

// Mount the app
app.mount("#app")
