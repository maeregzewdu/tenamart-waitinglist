<template>
  <li @click="handleClick" class="sidebar-item-container">
    <div class="sidebar-item" :class="{ 'active': active }">
      <i :class="icon" class="item-icon"></i>
      <span class="item-title">{{ title }}</span>
    </div>
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
      this.$emit('click')
    }
  }
}
</script>

<style scoped>
.sidebar-item-container {
  list-style: none;
  margin-bottom: 8px;
}

.sidebar-item {
  display: flex;
  align-items: center;
  padding: 12px 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.sidebar-item:hover {
  background-color: #F0F0F0;
}

.sidebar-item.active {
  background-color: rgba(16, 185, 129, 0.1);
}

.sidebar-item.active .item-icon,
.sidebar-item.active .item-title {
  color: #10B981;
}

.item-icon {
  font-size: 20px;
  margin-right: 12px;
  color: #64748B;
  transition: color 0.3s ease;
}

.item-title {
  font-size: 14px;
  font-weight: 400;
  color: #000000;
  transition: color 0.3s ease;
}
</style>