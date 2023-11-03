<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia';
export default {
    layout: AppLayout,
    components: { Head, Link },
    props: {
        users: Array
    },
    setup() {
        const deleteItem = (id) => {
            Inertia.delete(`/admin/user/${id}`);
        };

        const destroy = (id) => {
        if (window.confirm('Are you sure you want to delete this item?')) {
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
        <title>Users</title>
    </Head>
    <div class="pb-20">
        <div class="container grid grid-cols-1 p-5 mx-auto sm:w-full md:w-10/12">
            <div class="p-5 bg-white rounded-md shadow-md">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="w-full bg-gray-600">
                            <th class="px-16 py-2">
                                <span class="text-white">Name</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Email</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                       <tr v-for="(user, index) in users" :key="index" class="bg-white border">
                            <td class="justify-center px-16 py-2">{{ user.name }}</td>
                            <td class="justify-center px-16 py-2">{{ user.email }}</td>
                            <td class="flex gap-2 px-10 py-3 text-center">
                                <Link :href="`/admin/user/${user.id}/edit`" class="px-4 py-2 text-xs text-white bg-indigo-600 rounded shadow-sm focus:outline-none">Edit</Link>
                                <button @click.prevent="destroy(user.id)" class="px-4 py-2 text-xs text-white bg-red-600 rounded shadow-sm focus:outline-none"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>