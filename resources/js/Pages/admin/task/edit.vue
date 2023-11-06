<script>
import AppLayout from '@/layouts/apps.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import VBreadcrumb from '@/components/VBreadcrumb/index.vue'
import VInput from "@/components/VInput/index.vue"
import VButton from '@/components/VButton/index.vue';
import VSelect from '@/components/VSelect/index.vue';

export default {
    layout: AppLayout,

    components: {
            Head,
            Link,
            VBreadcrumb,
            VInput,
            VButton,
            VSelect
        },

    props:{
        task: Object,
        users: Array,
    },
        setup(props) {
            const form = reactive({
                title: props.task.title,
                description: props.task.description,
                status: props.task.status,
                user_id: props.task.user_id
            });

            const breadcrumb = [
            {
                name: "Tasks",
                active: false,
                to: route('task.index')
            },
        ];

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
                breadcrumb,
                submit,
            };
        }
}
</script>

<template>
    <Head>Edit Task</Head>
   <VBreadcrumb :routes="breadcrumb" />
   <div class="flex items-center justify-start mb-4 space-x-2 sm:mb-6">
       <h1 class="text-2xl font-bold md:text-3xl text-slate-800">Edit Task</h1>
   </div>
   <div class="bg-white border rounded-sm shadow-lg border-slate-200">
       <div class="p-6 space-y-6">
           <section>
               <div class="flex space-x-5">
                   <div class="w-1/2">
                       <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Title</h3>
                       <div class="mb-4 text-sm text-slate-500">Input your title</div>
                       <VInput placeholder="Insert Title" label="Title" :required="true" v-model="form.title" />
                   </div>
                   <div class="w-1/2">
                       <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Description</h3>
                       <div class="mb-4 text-sm text-slate-500">Input your email</div>
                       <VInput type="text" placeholder="Insert Description" label="Description" :required="true" v-model="form.description" />
                   </div>
               </div>
               <div class="flex space-x-5">
                   <div class="w-1/2 pt-5">
                       <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Status</h3>
                       <div class="mb-4 text-sm text-slate-500">Input status</div>
                       <VSelect type="select" placeholder="Insert status" label="Status" :required="true" v-model="form.status" />
                   </div>
                   <div class="w-1/2 pt-5">
                       <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Assign</h3>
                       <div class="mb-4 text-sm text-slate-500">Assign to user</div>
                       <VSelect type="select" placeholder="Insert user" label="Assign" :required="true" v-model="form.user_id">
                           <option selected disabled>Choose One</option>
                           <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                       </VSelect>
                   </div>
               </div>
           </section>
           <footer>
               <div class="flex flex-col px-6 py-3 border-t border-slate-200">
                   <div class="flex self-end space-x-3">
                       <VButton label="Discard" type="default" @click="discard" />
                       <VButton label="Save" type="primary" @click="submit" />
                   </div>
               </div>
           </footer>
       </div>
   </div>
</template>
