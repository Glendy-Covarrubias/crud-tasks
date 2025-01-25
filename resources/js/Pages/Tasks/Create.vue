<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
    is_completed: false
})

const cancel = () => {
    form.get(route('tasks.index'));
}
</script>

<template>
    <Head title="Crear tarea" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold leading-tight text-gray-900">
                Crear tarea
            </h2>
        </template>

        <div class="py-8 bg-gray-50">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="p-6 bg-white shadow-lg rounded-xl">
                    <form @submit.prevent="$event => form.post(route('tasks.store'))" class="space-y-6">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <InputLabel for="name" value="Nombre" />
                            <TextInput id="name" v-model="form.name" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" />
                            <InputError :message="form.errors.name" class="mt-1 text-sm text-red-600" />
                        </div>

                        <!-- Description Field -->
                        <div class="space-y-2">
                            <InputLabel for="description" value="Descripción" />
                            <TextInput id="description" v-model="form.description" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" />
                            <InputError :message="form.errors.description" class="mt-1 text-sm text-red-600" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-4">
                            <PrimaryButton :disabled="form.processing" class="w-auto bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                <i class="fa-solid fa-save mr-2"></i> Guardar
                            </PrimaryButton>
                            <button type="button" class="w-auto bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50" @click="cancel()">
                                <i class="fa-solid fa-times mr-2"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
