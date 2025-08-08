<template>
    <li>
        <router-link 
            :to="to" 
            class="flex items-center px-4 py-3 transition"
            :style="style"
        >
            <i :class="'ri-' + icon" class="mr-3 text-lg"></i>
            <span style="font-family: 'Raleway'">{{ text }}</span>
        </router-link>
    </li>
</template>

<script>
export default {
    name: 'SidebarItem',
    props: {
        to: {
            type: String,
            required: true
        },
        icon: {
            type: String,
            required: true
        },
        text: {
            type: String,
            required: true
        },
        style: {
            type: String,
            default: ''
        },
        active: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
.router-link-active {
    background: #F0F0F0;
    border-radius: 5px;
}
</style>