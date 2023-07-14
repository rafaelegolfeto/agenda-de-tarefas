<template>
    <div class="max-w-md mx-auto mt-8">
        <Link :href="`/tasks/tasklist`"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Voltar
        </Link>
        <h2 class="text-lg font-semibold mb-4">{{ task.title }}</h2>
        <p class="text-gray-500 mb-4">Data de Vencimento: {{ task.due_date }}</p>
        <p class="mb-4">{{ task.description }}</p>
        <img v-if="task.image_path" :src="task.image_path" alt="Imagem da Tarefa" class="w-full mb-4" />


        <div class="flex items-center gap-x-4 mb-4">
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

            <Link :href="`/tasks/${task.id}/edit`"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Editar
            </Link>

            <Link :href="`/tasks/${task.id}`" method="delete" as="button" type="button"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Delete</Link>
        </div>

    </div>
</template>
  
<script setup>
import { defineProps } from 'vue';
import { usePage, Inertia, $inertia, Link } from '@inertiajs/inertia-vue3';


const props = defineProps({
    task: Object,
});

</script>
