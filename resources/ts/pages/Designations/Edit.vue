<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import type { Designation } from '@/types/designation'

const props = defineProps<{
    designation: Designation
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Designations', href: '/designations' },
    { title: 'Edit', href: '#' },
]

const form = useForm<{
    name: string
    level: number | null
    description: string
    status: 'active' | 'inactive'
}>({
    name: props.designation.name,
    level: props.designation.level,
    description: props.designation.description ?? '',
    status: props.designation.status,
})

function submit() {
    form.put(route('designations.update', props.designation.id))
}
</script>

<template>
    <Head title="Edit Designation" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div>
                <h1 class="text-2xl font-semibold">Edit Designation</h1>
                <p class="text-sm text-muted-foreground mt-1">
                    Editing: <span class="font-medium">{{ designation.name }}</span>
                </p>
            </div>

            <div class="rounded-xl border border-sidebar-border p-6 space-y-5 max-w-2xl">

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Name <span class="text-destructive">*</span>
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                        :class="{ 'border-destructive': form.errors.name }"
                    />
                    <p v-if="form.errors.name" class="text-destructive text-xs mt-1">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Level</label>
                    <input
                        v-model.number="form.level"
                        type="number"
                        min="1"
                        class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                        :class="{ 'border-destructive': form.errors.level }"
                    />
                    <p v-if="form.errors.level" class="text-destructive text-xs mt-1">{{ form.errors.level }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea
                        v-model="form.description"
                        rows="3"
                        class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select
                        v-model="form.status"
                        class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-2">
                    <button
                        @click="submit"
                        :disabled="form.processing"
                        class="px-5 py-2 bg-primary text-primary-foreground text-sm rounded-lg hover:opacity-90 disabled:opacity-50"
                    >
                        {{ form.processing ? 'Updating...' : 'Update Designation' }}
                    </button>

                    <a :href="route('designations.index')"
                        class="px-5 py-2 border border-sidebar-border text-sm rounded-lg hover:bg-muted"
                    >Cancel</a>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
