<script setup>
import { ref } from "vue";
import { bool, object } from "vue-types";
import VDialog from '@/components/VDialog/index.vue';
import VBadge from '@/components/VBadge/index.vue';
import VButton from '@/components/VButton/index.vue';

const props = defineProps({
    openDialog: bool(),
    data: object().def({})
})

const emit = defineEmits(['close', 'successSubmit'])
</script>

<template>
    <VDialog :showModal="openDialog" title="Detail Log" size="2xl">
        <template v-slot:close>
            <button class="text-slate-400 hover:text-slate-500" @click="$emit('close')">
                <div class="sr-only">Close</div>
                <svg class="w-4 h-4 fill-current">
                    <path
                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                </svg>
            </button>
        </template>
        <template v-slot:content>
            <div class="grid grid-cols-2 gap-2" v-if="data">
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Created At</div>
                    <div class="font-normal text-sm text-slate-500">{{ data.created_at }}</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Created By</div>
                    <div class="font-normal text-sm text-slate-500">{{ data.user?.name }} ({{ data.user?.email }})</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Type</div>
                    <div class="font-normal text-sm text-slate-500">{{ data.type?.replace(/_/g, " ") }}</div>
                </div>
                <div>
                    <div class="font-medium text-sm text-slate-600 mb-1">Action</div>
                    <div class="font-normal text-sm text-slate-500 capitalize">{{ data.event?.replace(/_/g, " ") }}</div>
                </div>
            </div>

            <section class="p-5 border border-slate-300 rounded mt-5">
                <div class="font-semibold text-slate-800 text-base mb-3">Log Information</div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <div class="font-medium text-sm text-slate-600 mb-1">Ip Address</div>
                        <div class="font-normal text-sm text-slate-500">{{ data.ip_address }}</div>
                    </div>
                    <div>
                        <div class="font-medium text-sm text-slate-600 mb-1">Status Code</div>
                        <div class="font-normal text-sm text-slate-500">{{ data.status_code }}</div>
                    </div>
                    <div class="col-span-2">
                        <div class="font-medium text-sm text-slate-600 mb-1">Endpoint</div>
                        <div class="font-normal text-sm text-slate-500 bg-neutral-900 !text-white p-2 rounded-md">{{ data.url }}</div>
                    </div>
                    <div class="col-span-2">
                        <div class="font-medium text-sm text-slate-600 mb-1">Request</div>
                        <pre class="font-normal text-sm text-slate-500 bg-neutral-900 !text-white p-2 rounded-md w-full overflow-scroll">{{ data.request }}</pre>
                    </div>
                    <div class="col-span-2">
                        <div class="font-medium text-sm text-slate-600 mb-1">Response</div>
                        <pre class="font-normal text-sm text-slate-500 bg-neutral-900 !text-white p-2 rounded-md w-full overflow-scroll">{{ data.response }}</pre>
                    </div>
                </div>
            </section>
        </template>
        <template v-slot:footer>
            <div class="flex flex-wrap justify-end space-x-2">
                <VButton label="Close" type="default" @click="$emit('close')" />
            </div>
        </template>
    </VDialog>
</template>