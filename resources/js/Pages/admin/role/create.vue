<script>
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';
export default {
    layout: AppLayout,

    setup() {
            const form = reactive({
                name: '',
            });

            const submit = () => {
                Inertia.post('/admin/roles', {
                    name: form.name,
                });
            }
            
            return {
                form,
                submit,
            };
        }
}
</script>

<template>
    <div class="pb-20">
        <div class="container grid grid-cols-1 p-5 mx-auto sm:w-full md:w-6/12">

            <form @submit.prevent="submit">
                <div class="p-5 bg-white rounded-md shadow-md">
                    <div class="text-xl">
                        Add roles
                    </div>
                    <div class="mt-3 mb-2 border-2 border-gray-200"></div>

                    <div class="mb-2">
                        <label class="mt-2">Name Role</label>
                        <input type="text" v-model="form.name"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none h-7 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Nama Lengkap">
                    </div>

                    <div>
                        <button
                            class="inline-block w-full px-3 py-1 mt-4 text-xl text-white bg-gray-700 rounded-md shadow-md focus:outline-none focus:bg-gray-900">Save
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</template>