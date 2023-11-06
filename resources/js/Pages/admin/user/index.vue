<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia';
import VBreadcrumb from '@/components/VBreadcrumb/index.vue'
import VDataTable from '@/components/VDataTable/index.vue';
import VDropdownEditMenu from '@/components/VDropdownEditMenu/index.vue';
import VButton from '@/components/VButton/index.vue';
import VEmpty from '@/components/src/icons/VEmpty.vue';
export default {
    layout: AppLayout, 
    components: { Head, Link, VBreadcrumb, VDataTable, VDropdownEditMenu, VEmpty, VButton },
    props: {
        users: Array
    },
    setup() {
        const heads = ["Name", "Email", ""];
        
        const breadcrumb = [
            {
                name: "Dashboard",
                active: false,
                to: route('dashboard.index')
            },
            {
                name: "Users",
                active: false,
                to: route('users.index')
            },
        ];

        const handleAddUser = () => {
            Inertia.visit(route('users.create'));
        }
        
        const deleteItem = (id) => {
            Inertia.delete(`/admin/users/${id}`);
        };

        const destroy = (id) => {
        if (window.confirm('Are you sure you want to delete this data?')) {
            deleteItem(id);
            }
        };
        
        return {
            destroy,
            heads,
            handleAddUser,
            breadcrumb
        }
    }
}
</script>

<template>
    <Head  />
        <title>Users</title>
        <VBreadcrumb :routes="breadcrumb" />

    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <h1 class="text-2xl font-bold md:text-3xl text-slate-800">Users</h1>
    </div>

    <div class="bg-white border rounded-sm shadow-lg border-slate-200"
        :class="isLoading && 'min-h-[40vh] sm:min-h-[50vh]'">
        <header class="items-center justify-between block px-4 py-6 sm:flex">
            <h2 class="font-semibold text-slate-800">
                All Logs <span class="text-slate-400 !font-medium ml">12</span>
            </h2>
            <div class="flex justify-end mt-3 space-x-2 sm:mt-0 sm:justify-between">
                <VButton label="Add Users" type="primary" @click="handleAddUser"/>
            </div>
        </header>

        <VDataTable :heads="heads" :isLoading="isLoading">
            <tr v-for="(data, index) in users" :key="index" >
                <td class="h-16 px-4 whitespace-nowrap"> {{ data.name }}</td>
                <td class="h-16 px-4 whitespace-nowrap"> {{ data.email }} </td>
                <td class="h-16 px-4 text-right whitespace-nowrap">
                    <VDropdownEditMenu class="relative inline-flex r-0" :align="'right'"
                        :last="index === users.length - 1 ? true : false">
                        <Link :href="`/admin/users/${data.id}/edit`" class="flex items-center p-3 cursor-pointer hover:bg-slate-100">Edit</Link>
                        <li class="cursor-pointer hover:bg-slate-100" @click="destroy(data.id)" v-if="!data.is_default">
                            <div class="flex items-center p-3">
                                <span>
                                    <VTrash color="danger" />
                                </span>
                                <span>Delete Roles</span>
                            </div>
                        </li>
                    </VDropdownEditMenu>
                </td>
            </tr>
        </VDataTable>
    </div>
</template>
