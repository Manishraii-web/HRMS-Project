<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import type { Designation } from '@/types/designation'

const props = defineProps<{
    designation: Designation
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Designations', href: '/designations' },
    { title: props.designation.name, href: '#' },
]
</script>

<template>
    <Head :title="designation.name" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">{{ designation.name }}</h1>
                    <p class="text-sm text-muted-foreground mt-1">
                        Level: {{ designation.level ?? '—' }}
                    </p>
                </div>
                <div class="flex gap-3">
                    <a :href="route('designations.edit', designation.id)"
                       class="px-4 py-2 bg-primary text-primary-foreground text-sm rounded-lg hover:opacity-90">
                        Edit
                    </a>
                    <a :href="route('designations.index')"
                       class="px-4 py-2 border border-sidebar-border text-sm rounded-lg hover:bg-muted">
                        Back
                    </a>
                </div>
            </div>

            <div class="rounded-xl border border-sidebar-border divide-y max-w-2xl">
                <div class="px-6 py-4 flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">Status</span>
                    <span
                        class="px-2 py-1 rounded-full text-xs font-medium"
                        :class="designation.status === 'active'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-muted text-muted-foreground'"
                    >{{ designation.status }}</span>
                </div>
                <div class="px-6 py-4 flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">Level</span>
                    <span class="text-sm">{{ designation.level ?? '—' }}</span>
                </div>
                <div class="px-6 py-4 flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">Description</span>
                    <span class="text-sm">{{ designation.description ?? '—' }}</span>
                </div>
                <div class="px-6 py-4 flex justify-between items-center">
                    <span class="text-sm text-muted-foreground">Created</span>
                    <span class="text-sm">{{ designation.created_at }}</span>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
