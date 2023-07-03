<template>
    <div class="max-w-md mx-auto mt-8">
      <ul role="list" class="divide-y divide-gray-100">
        <li v-for="task in tasks" :key="task.id" class="flex justify-between gap-x-6 py-5">
          <div class="flex gap-x-4">
            <div class="min-w-0 flex-auto">
              <p class="text-sm font-semibold leading-6 text-gray-900">
                <span :class="{ 'line-through': task.completed }">{{ task.title }}</span>
              </p>
              <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ task.description }}</p>
            </div>
          </div>
          <div class="hidden sm:flex sm:flex-col sm:items-end">
            <p class="text-sm leading-6 text-gray-900">DIFÍCIL</p>
            <p class="mt-1 text-xs leading-5 text-gray-500">
              Prazo <time :datetime="task.due_date">{{ task.due_date }}</time>
            </p>
          </div>
          <div class="flex gap-x-2">
            <inertia-link :href="route('tasks.show', task.id)"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded-sm text-xs focus:outline-none focus:shadow-outline h-6">Detalhes</inertia-link>
            <button @click="toggleTaskCompleted(task.id)"
              :class="[
                'bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-2 rounded-sm text-xs focus:outline-none focus:shadow-outline h-6',
                { 'line-through': task.completed }
              ]">
              <span v-if="!task.completed">Concluída</span>
              <span v-else>&check;</span>
            </button>
          </div>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { usePage, useRoute, InertiaLink } from '@inertiajs/inertia-vue3';
  
  const props = defineProps({
    tasks: Array, // Recebe a lista de tarefas do controlador
  });
  
  const toggleTaskCompleted = (taskId) => {
    const taskIndex = props.tasks.findIndex(task => task.id === taskId);
    if (taskIndex !== -1) {
      props.tasks[taskIndex].completed = !props.tasks[taskIndex].completed;
    }
  };
  </script>
  
  <style scoped>
  .line-through {
    text-decoration: line-through;
  }
  </style>