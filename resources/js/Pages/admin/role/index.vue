<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia';
export default {
    layout: AppLayout,
    components: { Head, Link },
    props: {
        roles: Array
    },
    setup() {
        const deleteItem = (id) => {
            Inertia.delete(`/admin/roles/${id}`);
        };

        const destroy = (id) => {
        if (window.confirm('Are you sure you want to delete this data?')) {
            deleteItem(id);
            }
        };
        
        return {
            destroy
        }
    }
}
</script>

<template>
    <Head>
        <title>Roles</title>
    </Head>
    <div class="pb-20">
        <div class="container grid grid-cols-1 p-5 mx-auto sm:w-full md:w-10/12">
            <div class="flex justify-end mb-2">
                <Link href="/admin/roles/create" class="px-4 py-3 text-xs text-white bg-indigo-600 rounded shadow-sm focus:outline-none">Create</Link>
            </div>
            <div class="p-5 bg-white rounded-md shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="w-full bg-gray-600">
                            <th class="px-16 py-2">
                                <span class="text-white">Name</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Guard name</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                       <tr v-for="(role, index) in roles" :key="index" class="bg-white border">
                            <td class="flex justify-center px-16 py-2">{{ role.name }}</td>
                            <td class="px-16 py-2 text-center">{{ role.guard_name }}</td>
                            <td class="flex justify-center gap-2 px-10 py-3">
                                <Link :href="`/admin/roles/${role.id}/edit`" class="px-4 py-2 text-xs text-white bg-indigo-600 rounded shadow-sm focus:outline-none">Edit</Link>
                                <button @click.prevent="destroy(role.id)" class="px-4 py-2 text-xs text-white bg-red-600 rounded shadow-sm focus:outline-none"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>