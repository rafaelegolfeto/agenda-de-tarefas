<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage, useRoute, InertiaLink } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';



const form = reactive({
    title: null,
    description: null,
    due_date: null,
    image: null,
})

function submit() {
    router.post('/tasks', form)
}

function onFileChange(event) {
    form.image = event.target.files[0];
}

</script>

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
                            <NavLink :href="route('tasks.create')" :active="route().current('tasks.create')">
                                Criar Tarefas
                            </NavLink>
                            <NavLink :href="route('tasks.tasklist')">
                                Listas de Tarefas
                            </NavLink>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('tasks.create')" :active="route().current('tasks.create')">
                        Criar Tarefas
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('tasks.tasklist')">
                        Listas de Tarefas
                    </ResponsiveNavLink>
                </div>
            </div>
        </nav>

    </div>
    <div class="max-w-md mx-auto mt-8">
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