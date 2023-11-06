<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/apps.vue';
import { Inertia } from '@inertiajs/inertia'; 
import { reactive } from 'vue';
import VBreadcrumb from '@/components/VBreadcrumb/index.vue'
import VInput from "@/components/VInput/index.vue"
import VButton from '@/components/VButton/index.vue';
export default {
    layout: AppLayout,

    props: {
        user: Object
    },

    components : {
    Head,
    Link,
    VBreadcrumb,
    VInput,
    VButton,
    Head
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
    <Head>Edit Users</Head>
    <VBreadcrumb :routes="breadcrumb" />
    <div class="flex items-center justify-start mb-4 space-x-2 sm:mb-6">
        <h1 class="text-2xl font-bold md:text-3xl text-slate-800">Edit User</h1>
    </div>
    <div class="bg-white border rounded-sm shadow-lg border-slate-200">
        <div class="p-6 space-y-6">
            <section>
                <div class="flex space-x-5">
                    <div class="w-1/2">
                        <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Name</h3>
                        <div class="mb-4 text-sm text-slate-500">Input your name</div>
                        <VInput placeholder="Insert Name" label="Name" :required="true" v-model="form.name" />
                    </div>
                    <div class="w-1/2">
                        <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Email</h3>
                        <div class="mb-4 text-sm text-slate-500">Input your email</div>
                        <VInput placeholder="Insert Email" label="Email" :required="true" v-model="form.email" />
                    </div>
                </div>
                <div class="flex space-x-5">
                    <div class="w-1/2 pt-5">
                        <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Password</h3>
                        <div class="mb-4 text-sm text-slate-500">Input your password</div>
                        <VInput type="password" placeholder="Insert password" label="Password" :required="true" v-model="form.password" />
                    </div>
                    <div class="w-1/2 pt-5">
                        <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Confirmation Password</h3>
                        <div class="mb-4 text-sm text-slate-500">Repeat your password</div>
                        <VInput type="password" placeholder="Insert Repeat Password" label="Repeat Password" :required="true" v-model="form.password_confirmation" />
                    </div>
                </div>
            </section>
            <footer>
                <div class="flex flex-col px-6 py-3 border-t border-slate-200">
                    <div class="flex self-end space-x-3">
                        <VButton label="Discard" type="default" @click="discard" />
                        <VButton label="Save" type="primary" @click="update" />
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
