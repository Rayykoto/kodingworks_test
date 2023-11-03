<script>
import AppLayout from '@/layouts/apps.vue';

import { Head, Link } from '@inertiajs/inertia-vue3';

import { reactive } from 'vue';

import { Inertia } from '@inertiajs/inertia';
export default {
    layout: AppLayout,
    props:{
        task: Object,
        users: Array 
    },
    components: {
            Head,
            Link
        },

        setup(props) {
            const form = reactive({
                title: props.task.title,
                description: props.task.description,
                status: props.task.status,
                user_id: props.task.user_id
            });

            const submit = () => {
                Inertia.put(`/admin/task/${props.task.id}`, {
                    title: form.title,
                    description: form.description,
                    status: form.status,
                    user_id: form.user_id
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
        <div class="container grid grid-cols-1 p-5 mx-auto sm:w-full md:w-10/12">

            <form @submit.prevent="submit">
                <div class="p-5 bg-white rounded-md shadow-md">
                    <div class="text-xl">
                        Add task
                    </div>
                    <div class="mt-3 mb-2 border-2 border-gray-200"></div>

                    <div class="mb-2">
                        <label class="mt-2">Title</label>
                        <input type="text" v-model="form.title"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none h-7 focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Title">
                    </div>

                    <div class="mb-2">
                        <label class="mt-2">Descripton</label>
                        <textarea
                            v-model="form.description"
                            class="w-full p-5 mt-2 placeholder-gray-600 bg-gray-200 border border-gray-200 rounded shadow-sm appearance-none focus:outline-none focus:placeholder-gray-600 focus:bg-white focus-within:text-gray-600"
                            placeholder="Description"
                            type="textarea"
                            rows="4"
                        ></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="mb-5 cols-span-1">
                            <label class="mt-2">Status</label>
                            <select 
                                v-model="form.status" class="inline-block w-full px-3 py-1 text-xl rounded-md">
                                <option selected>
                                    Choose One
                                </option>
                                <option value="draft">Draft</option>
                                <option value="on_progress">On Progress</option>
                                <option value="done">Done</option>
                            </select>
                        </div>

                        <div class="mb-5 cols-span-1">
                            <label class="mt-2">Assign</label>
                            <select v-model="form.user_id" class="inline-block w-full px-3 py-1 text-xl rounded-md">
                                <option selected disabled>Choose One</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button
                            class="inline-block w-full px-3 py-1 text-xl text-white bg-gray-700 rounded-md shadow-md focus:outline-none focus:bg-gray-900">Save
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</template>