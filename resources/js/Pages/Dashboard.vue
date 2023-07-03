<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Create from '@/Pages/Tasks/Create.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bem-Vindo ao Gerenciador de Tarefas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
                    <Create />
                    <div class="mb-4"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
