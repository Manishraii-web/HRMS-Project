<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'
import type { SharedData } from '@/types'

const page = usePage<SharedData>()

const success = computed(() => page.props.flash.success)
const error = computed(() => page.props.flash.error)

const visible = ref(false)

watch(
    () => ({ success: success.value, error: error.value }),
    (val) => {
        if (val.success || val.error) {
            visible.value = true
            setTimeout(() => (visible.value = false), 4000)
        }
    },
    { immediate: true }
)
</script>

<template>
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 translate-y-[-8px]"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-[-8px]"
    >
        <div v-if="visible" class="fixed top-4 right-4 z-50 flex flex-col gap-2">
            <div
                v-if="success"
                class="flex items-center gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-md"
            >
                <span class="text-green-500">✓</span>
                {{ success }}
            </div>
            <div
                v-if="error"
                class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-md"
            >
                <span class="text-red-500">✕</span>
                {{ error }}
            </div>
        </div>
    </Transition>
</template>
