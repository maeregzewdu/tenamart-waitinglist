<template>
    <li @click="handleClick" class="sidebar-item-container">
        <a href="#" class="sidebar-item" :class="{ 'active': active }">
            <div class="icon-container">
                <i :class="icon"></i>
            </div>
            <span class="item-title">{{ title }}</span>
        </a>
    </li>
</template>

<script>
export default {
    props: {
        title: String,
        icon: String,
        active: Boolean
    },
    methods: {
        handleClick() {
            this.$emit('click');
        },
    },
};
</script>

<style scoped>
.sidebar-item-container {
    list-style: none;
    margin: 5px 0;
}

.sidebar-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    color: #000;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.2s;
}

.sidebar-item:hover {
    background: #f0f0f0;
}

.sidebar-item.active {
    background: #F0F0F0;
    font-weight: 500;
}

.icon-container {
    margin-right: 15px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-container i {
    font-size: 18px;
}

.item-title {
    font-family: 'Raleway';
    font-weight: 400;
    font-size: 14px;
}
</style>