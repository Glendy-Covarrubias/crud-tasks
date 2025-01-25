<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    tasks: {}
});

const form = useForm({
    id: ''
});

const deleteTask = (id, name) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    });
    alerta.fire({
        title: `¿Estás seguro de borrar ${name} ?`,
        icon:'question',
        showCancelButton: true,
        confirmButtonText:`<i class="fa-solid fa-check"></i> Yes, delete`,
        cancelButtonText: `<i class="fa-solid fa-ban"></i> Cancel`
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('tasks.destroy', id));
        }
    });
}

const changeStatus = (id, is_completed) => {
    form.patch(route('tasks.changeStatusCompleted', [id, is_completed]));
}
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tareas
            </h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex justify-between items-center w-full px-4 sm:px-6 lg:px-8">
                    <!-- Título alineado a la izquierda -->
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">Tareas</h2>

                    <!-- Botón alineado a la derecha -->
                    <Link 
                        :href="route('tasks.create')" 
                        :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                        <i class="fa-solid fa-plus-circle"></i> Agregar
                    </Link>
                </div>
            </div>

            <!-- Contenedor para la tabla con desplazamiento horizontal en dispositivos móviles -->
            <div class="bg-white grid v-screen place-items-center px-4 sm:px-6 lg:px-8 pb-8">
                <div class="overflow-x-auto w-full">
                    <table class="table-auto border border-gray-400 w-full table-layout-fixed">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-sm sm:text-base">#</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Nombre</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Descripción</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Estado</th>
                                <th class="px-4 py-2 text-sm sm:text-base w-48">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task, i in tasks" :key="task.id" class="text-sm sm:text-base">
                                <td class="border border-gray-400 px-4 py-2">{{ (i+1) }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ task.name }}</td>
                                <td class="border border-gray-400 px-4 py-2 break-words">{{ task.description }}</td> <!-- Permite el ajuste de texto largo -->
                                <td class="border border-gray-400 px-4 py-2">
                                    <label class="inline-flex items-center me-5 cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" :checked="task.is_completed" @change="changeStatus(task.id, task.is_completed)">
                                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600"></div>
                                        <span class="ms-3 text-sm font-medium text-gray-900">{{ task.is_completed ? "Completo" : 'Incompleto'}}</span>
                                    </label>
                                </td>
                                <td class="border border-gray-400 px-4 py-2 w-48">
                                    <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0 justify-center items-center">
                                        <!-- Botón de Editar -->
                                        <Link 
                                            :href="route('tasks.edit', task.id)" 
                                            :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs flex items-center justify-center'">
                                            <i class="fa-solid fa-edit mr-2"></i> Editar
                                        </Link>

                                        <!-- Botón de Eliminar -->
                                        <DangerButton @click="deleteTask(task.id, task.name)" :class="'flex items-center justify-center capitalize text-xs'">
                                            <i class="fa-solid fa-trash mr-2"></i> Eliminar
                                        </DangerButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
