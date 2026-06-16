<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Departments', href: '/departments' },
    { title: 'Create', href: '/departments/create' },
]

const form = useForm({
    name: '',
    code: '',
    description: '',
    status: 'active',
})

// function submit() {
//     form.post(route('departments.store'))
// }
function submit() {
    form.post(route('departments.store'), {
        onSuccess: () => console.log('SUCCESS - saved!'),
        onError: (errors) => console.log('VALIDATION ERRORS:', errors),
        onFinish: () => console.log('finished, errors:', form.errors),
    })
}
</script>

<template>
    <Head title="Create Department" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div>
                <h1 class="text-2xl font-semibold">Create Department</h1>
                <p class="text-sm text-muted-foreground mt-1">Add a new department to your organisation.</p>
            </div>

            <div class="rounded-xl border border-sidebar-border p-6 space-y-5 max-w-2xl">

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Name <span class="text-destructive">*</span>
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        placeholder="e.g. Engineering"
                        class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                        :class="{ 'border-destructive': form.errors.name }"
                    />
                    <p v-if="form.errors.name" class="text-destructive text-xs mt-1">{{ form.errors.name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Code <span class="text-destructive">*</span>
                    </label>
                    <input
                        v-model="form.code"
                        type="text"
                        placeholder="e.g. ENG"
                        class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm font-mono bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                        :class="{ 'border-destructive': form.errors.code }"
                    />
                    <p v-if="form.errors.code" class="text-destructive text-xs mt-1">{{ form.errors.code }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea
                        v-model="form.description"
                        rows="3"
                        placeholder="Optional description..."
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
                        {{ form.processing ? 'Saving...' : 'Save Department' }}
                    </button>

                       <a :href="route('departments.index')"
                        class="px-5 py-2 border border-sidebar-border text-sm rounded-lg hover:bg-muted"
                    >Cancel</a>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
