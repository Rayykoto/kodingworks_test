<script>
import AppLayout from '@/layouts/apps.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import VBreadcrumb from '@/components/VBreadcrumb/index.vue'
import VInput from "@/components/VInput/index.vue"
import VButton from '@/components/VButton/index.vue';
import VCheckbox from '@/components/VCheckbox/index.vue';
export default {
    layout: AppLayout,

    props: {
        permissions: Array
    },

    components: {
        Head,
        Link,
        VBreadcrumb,
        VInput,
        VButton,
        VCheckbox
    },

    setup() {
            const form = reactive({
                name: '',
                permissions: [],
            });

            const submit = () => {
                Inertia.post('/admin/roles', {
                    name: form.name,
                    permissions: form.permissions
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
    <Head>Add Role</Head>
    <VBreadcrumb :routes="breadcrumb" />
    <div class="flex items-center justify-start mb-4 space-x-2 sm:mb-6">
        <h1 class="text-2xl font-bold md:text-3xl text-slate-800">Add Role</h1>
    </div>
    <div class="bg-white border rounded-sm shadow-lg border-slate-200">
        <div class="p-6 space-y-6">
            <section>
                    <div class="w-full">
                        <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Name</h3>
                        <div class="mb-4 text-sm text-slate-500">Input your name</div>
                        <VInput placeholder="Insert Name" label="Name" :required="true" v-model="form.name" />
                    </div>
                    <div class="w-full">
                        <h3 class="mb-1 text-xl font-bold leading-snug text-slate-800">Permissions</h3>
                        <div v-for="(permission, index) in permissions" :key="index" class="mb-4 text-sm text-slate-500">
                            <VCheckbox placeholder="Insert Name" :label="permission.name" :required="true" v-model="form.permissions"  />
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
