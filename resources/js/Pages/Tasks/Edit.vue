<script setup>
import { defineProps, ref } from 'vue';
import { route, Link, useForm, useInertia } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia"


const props = defineProps({
    task: Object,
    image: String
});

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    due_date: props.task.due_date,
    image: null,
    newImage: null,
})

function updateTask() {
    Inertia.post(`/tasks/${props.task.id}`, {
        _method: 'put',
        title: form.title,
        description: form.description,
        due_date: form.due_date,
        image: form.image,
        newImage: null,
    });

};

function onFileChange(event) {
    form.image = event.target.files[0];
}
</script>

<template>
    <div class="max-w-md mx-auto mt-8">
        <h2 class="text-lg font-semibold mb-4">Editar Tarefa</h2>
        <form @submit.prevent="updateTask">
            <!-- Campos do formulário -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
                <input v-model="form.title" type="text" id="title" name="title" class="form-input w-full" required>
                <p v-if="form.errors.title" class="text-red-500 mt-2">{{ form.errors.title[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Descrição:</label>
                <textarea v-model="form.description" id="description" name="description" rows="4"
                    class="form-textarea w-full" required></textarea>
                <p v-if="form.errors.description" class="text-red-500 mt-2">{{ form.errors.description[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-gray-700 font-bold mb-2">Data de Vencimento:</label>
                <input v-model="form.due_date" type="date" id="due_date" name="due_date" class="form-input w-full" required>
                <p v-if="form.errors.due_date" class="text-red-500 mt-2">{{ form.errors.due_date[0] }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Imagem:</label>
                <img v-if="task.image_path" :src="task.image_path" alt="Imagem da Tarefa" class="w-full mb-4" />
                <input 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="image" type="file" v-on:change="onFileChange" accept="image/*">
            </div>

            <!-- Botão de atualização -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Atualizar Tarefa
            </button>
        </form>
    </div>
</template>




