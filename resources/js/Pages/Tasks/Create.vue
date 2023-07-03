<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage, useRoute, InertiaLink } from '@inertiajs/inertia-vue3';

const form = reactive({
    title: null,
    description: null,
    due_date: null,
    image: null,
})

function submit() {
    router.post('/tasks', form)
}
</script>

<template>
    <div class="max-w-md mx-auto mt-8">
        <!-- <inertia-link :href="route('dashboard')"
            class="flex items-center text-gray-700 hover:text-gray-900 text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-4 h-4 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg></inertia-link> -->
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submit">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Título:</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="title" type="text" v-model="form.title" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Descrição:</label>
                <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="description" v-model="form.description" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">Data de Vencimento:</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="due_date" type="date" v-model="form.due_date" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Imagem:</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="image" type="file" v-on:change="onFileChange" accept="image/*">
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Criar Tarefa
                </button>
            </div>
        </form>

        <a class="bg-gray-200 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline
           inline-block text-center align-middle cursor-pointer transition ease-in duration-200"
            :href="route('tasks.tasklist')">
            Visualizar Tarefas
        </a>

    </div>
</template>