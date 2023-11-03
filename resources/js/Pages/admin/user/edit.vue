<script>
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia'; 
import { reactive } from 'vue';
export default {
    layout: AppLayout,

    props: {
        user: Object
    },

    setup(props) {
            const form = reactive({
                name: props.user.name,
                email: props.user.email,
                password: '',
                password_confirmation: '',
            });

            const update = () => {
                Inertia.put(`/admin/users/${props.user.id}`, {
                    name: form.name,
                    email: form.email,
                    password: form.password,
                    password_confirmation: form.password_confirmation,
                });
            }
            
            return {
                form,
                update,
            };
        }
}

</script>

<template>
    <div class="pb-20">
        <div class="container grid grid-cols-1 p-5 mx-auto sm:w-full md:w-10/12">
            <form @submit.prevent="update">
                <div class="p-5 bg-white rounded-md shadow-md">
                    <div class="text-xl">
                        Add users
                    </div>
                    <div class="mt-3 mb-2 border-2 border-gray-200"></div>

                    <div class="mb-2">
                        <label class="mt-2">Nama Lengkap</label>
                        <input type="text" v-model="form.name"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none h-7 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Nama Lengkap">
                    </div>

                    <div class="mb-2">
                        <label class="mt-2">Alamat Email</label>
                        <input type="email" v-model="form.email"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none h-7 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Alamat Email">
                    </div>

                    <div class="mb-5 cols-span-1">
                        <label class="mt-2">Password</label>
                        <input type="password" v-model="form.password"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none h-7 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Password">
                    </div>

                    <div class="mb-5 cols-span-1">
                        <label class="mt-2">Konfirmasi Password</label>
                        <input type="password" v-model="form.password_confirmation"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none h-7 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Konfirmasi Password">
                    </div>

                    <div>
                        <button
                            class="inline-block w-full px-3 py-1 text-xl text-white bg-gray-700 rounded-md shadow-md focus:outline-none focus:bg-gray-900">Update
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</template>