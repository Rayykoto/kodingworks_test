<script>
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: AppLayout,
    props: {
        tasks: Array
    },
    components: { 
        Link, 
        Head 
    },
    setup() {
        const deleteItem = (id) => {
            Inertia.delete(`/admin/task/${id}`);
        };

        const destroy = (id) => {
        if (window.confirm('Are you sure you want to delete this data?')) {
            deleteItem(id);
            }
        };
        return {
            destroy
        }
    },
}
</script>

<template>
   <Head>
        <title>Tasks</title>
    </Head>
    <div class="pb-20">
        <div class="container grid grid-cols-1 p-5 mx-auto sm:w-full md:w-10/12">
            <div class="flex justify-end mb-2">
                <Link href="/admin/task/create" class="px-4 py-3 text-xs text-white bg-indigo-600 rounded shadow-sm focus:outline-none">Create</Link>
            </div>
            <div class="p-5 bg-white rounded-md shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="w-full bg-gray-600">
                            <th class="px-16 py-2">
                                <span class="text-white">Title</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Description</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Status</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Assign</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                       <tr v-for="(task, index) in tasks" :key="index" class="bg-white border">
                            <td class="justify-center px-16 py-2">{{ task.title }}</td>
                            <td class="justify-center px-16 py-2">{{ task.description }}</td>
                            <td class="justify-center px-16 py-2">{{ task.status }}</td>
                            <td v-if="task.user == null" class="justify-center px-16 py-2">-</td>
                            <td v-else class="justify-center px-16 py-2">{{ task.user.name }}</td>
                            <td class="flex gap-2 px-10 py-3 text-center">
                                <Link :href="`/admin/task/${task.id}/edit`" class="px-4 py-2 text-xs text-white bg-indigo-600 rounded shadow-sm focus:outline-none">Edit</Link>
                                <button @click.prevent="destroy(task.id)" class="px-4 py-2 text-xs text-white bg-red-600 rounded shadow-sm focus:outline-none"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>