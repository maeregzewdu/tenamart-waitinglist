<template>
  <div class="bg-white rounded-[10px] border border-[#E5E5E5] p-[20px] animate-pulse">
    <!-- Header Skeleton -->
    <div class="flex items-center space-x-3">
      <div class="bg-gray-200 w-[50px] h-[50px] rounded-lg"></div>
      <div class="flex flex-col space-y-2 flex-1">
        <div class="h-5 bg-gray-300 rounded w-40"></div>
        <div class="h-3 bg-gray-200 rounded w-28"></div>
      </div>
    </div>

    <hr class="my-5 text-neutral-200" />

    <!-- Quick Actions Skeleton List -->
    <div class="space-y-4">
      <div v-for="i in 4" :key="i" class="flex items-center space-x-4">
        <div class="h-[40px] w-[40px] bg-gray-300 rounded-md"></div>
        <div class="h-4 bg-gray-300 rounded w-32"></div>
      </div>
    </div>
  </div>
</template>
