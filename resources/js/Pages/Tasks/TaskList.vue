<template>
    <div class="max-w-md mx-auto mt-8">
        <ul role="list" class="divide-y divide-gray-100 ">
            <li v-for="task in tasks" :key="task.id" class="flex justify-between gap-x-6 py-5">
                <div class="flex gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ task.title }}</p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ task.description }}</p>
                    </div>
                </div>
                <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900">DIFÍCIL</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Prazo <time :datetime="task.due_date">{{ task.due_date }}</time>
                    </p>
                </div>
            </li>
        </ul>
    </div>
</template>
  

<script setup>
import { route } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    tasks: Array, // Recebe a lista de tarefas do controlador
});

const submitForm = async () => {
    const formData = new FormData();
    formData.append('title', form.title);
    formData.append('description', form.description);
    formData.append('due_date', form.due_date);

    try {
        const response = await $inertia.post(route('tasks.store'), formData);

        if (response.success) {
            window.location = route('tasks.tasklist');
        }
    } catch (error) {
        console.error(error);
        // Lidar com erros de criação de tarefa, se necessário
    }
};
</script>
