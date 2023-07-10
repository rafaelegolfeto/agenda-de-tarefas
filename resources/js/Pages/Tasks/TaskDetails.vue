<template>
    <div class="max-w-md mx-auto mt-8">
        <h2 class="text-lg font-semibold mb-4">{{ task.title }}</h2>
        <p class="text-gray-500 mb-4">Data de Vencimento: {{ task.due_date }}</p>
        <p class="mb-4">{{ task.description }}</p>
        <img v-if="task.image_path" :src="task.image_path" alt="Imagem da Tarefa" class="w-full mb-4" />


        <div class="flex items-center gap-x-4">
            <button v-if="!task.completed"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                @click="markAsCompleted">
                Marcar como Concluída
            </button>

            <button v-if="task.completed"
                class="bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-default"
                disabled>
                Concluída
            </button>
            <button
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                @click="deleteTask">
                Excluir Tarefa
            </button>
        </div>
    </div>
</template>
  
<script setup>
import { defineProps, onMounted, reactive } from 'vue';
import { route, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    task: Object, // Recebe os detalhes da tarefa do controlador
});

const markAsCompleted = async () => {
    try {
        await $inertia.post(`/tasks/${props.task.id}/mark-completed`);
        props.task.completed = true;
    } catch (error) {
        console.error(error);
        // Lidar com erros de marcação de tarefa como concluída, se necessário
    }
};


const deleteTask = async () => {
    if (confirm('Tem certeza de que deseja excluir esta tarefa?')) {
        try {
            await $inertia.delete(route('tasks.delete', { id: props.task.id }));
            window.location = route('tasks.tasklist');
        } catch (error) {
            console.error(error);
            // Lidar com erros de exclusão de tarefa, se necessário
        }
    }
};
</script>  