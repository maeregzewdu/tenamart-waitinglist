<template>
  <div class="bg-white h-fit rounded-[10px] border border-[#E5E5E5] p-[20px] animate-pulse">
    <!-- Header Skeleton -->
    <div class="flex items-center space-x-3">
      <div class="bg-gray-200 w-[50px] h-[50px] rounded-lg"></div>
      <div class="flex flex-col space-y-2 flex-1">
        <div class="h-5 bg-gray-300 rounded w-40"></div>
        <div class="h-3 bg-gray-200 rounded w-28"></div>
      </div>
    </div>

    <hr class="my-5 text-neutral-200" />

    <!-- List Skeletons -->
    <ul class="space-y-3">
      <li v-for="i in 5" :key="i" class="flex items-center bg-gray-50 rounded-md p-3">
        <div class="flex-shrink-0">
          <div class="rounded-md h-[40px] w-[40px] bg-gray-300"></div>
        </div>
        <div class="ml-4 flex flex-col space-y-2">
          <div class="h-4 bg-gray-300 rounded w-32"></div>
          <div class="h-3 bg-gray-200 rounded w-40"></div>
        </div>
      </li>
    </ul>
  </div>
</template>