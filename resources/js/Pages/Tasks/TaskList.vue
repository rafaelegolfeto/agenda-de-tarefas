<!-- <script setup>
import { usePage, useRoute, InertiaLink, useRemember } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';


const props = defineProps({
    tasks: Array, // Recebe a lista de tarefas do controlador
});

const tasks = useRemember(props.tasks);

const toggleTaskCompleted = (taskId) => {
  const task = tasks.find(task => task.id === taskId);
  if (task) {
    task.completed = !task.completed;
  }
};
</script> -->
  
<script setup>
import { usePage, useRoute, InertiaLink } from '@inertiajs/inertia-vue3';
import { useRemember } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const props = defineProps({
  tasks: Array, // Recebe a lista de tarefas do controlador
});

const tasks = useRemember(props.tasks);

const toggleTaskCompleted = (taskId) => {
  const task = tasks.find((task) => task.id === taskId);
  if (task) {
    const updatedTask = { ...task, completed: !task.completed };
    Inertia.post(`/tasks/${taskId}/mark-completed`, updatedTask);
  }
};
</script>




<style scoped>
.line-through {
    text-decoration: line-through;
}
</style>



<template>
    <div>
        <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px ml-0 sm:flex">
                                <NavLink :href="route('dashboard')">
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('tasks.create')">
                                    Criar Tarefas
                                </NavLink>
                                <NavLink :href="route('tasks.tasklist')" :active="route().current('tasks.tasklist')">
                                    Listas de Tarefas
                                </NavLink>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('tasks.create')">
                            Criar Tarefas
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('tasks.tasklist')" :active="route().current('tasks.tasklist')">
                            Listas de Tarefas
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

    </div>
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
                    <!-- <p class="text-sm leading-6 text-gray-900">DIFÍCIL</p> -->
                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Prazo <time :datetime="task.due_date">{{ task.due_date }}</time>
                    </p>
                </div>
                <div class="flex gap-x-2">
                    <inertia-link :href="route('tasks.show', task.id)"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded-sm text-xs focus:outline-none focus:shadow-outline h-6">Detalhes</inertia-link>
                    <button @click="toggleTaskCompleted(task.id)" :class="[
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
