<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import type { BreadcrumbItem } from '@/types'
import type { PaginatedDepartments } from '@/types/department'

const page = usePage()

const props = defineProps<{
    departments: PaginatedDepartments
    filters: { search: string }
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Departments', href: '/departments' },
]

const search = ref(props.filters.search)

watch(search, (value) => {
    router.get(route('departments.index'), { search: value }, {
        preserveState: true,
        replace: true,
    })
})

function destroy(department: {id: number; employees_count: number}) {
    const message = department.employees_count > 0
   ? `This department has ${department.employees_count} employee${department.employees_count !== 1 ? 's' : ''}. Deleting it will also remove their employee record${department.employees_count !== 1 ? 's' : ''}. Continue?`
        : 'Are you sure you want to delete this department?'
    if(!confirm(message)) return
    router.delete(route('departments.destroy', department.id))
}
</script>

<template>
    <Head title="Departments" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">Departments</h1>
                    <p class="text-sm text-muted-foreground mt-1">
                        {{ departments.meta.total }} department{{ departments.meta.total !== 1 ? 's' : '' }} total
                    </p>
                </div>
                <a :href="route('departments.create')"
                   class="px-4 py-2 bg-primary text-primary-foreground text-sm rounded-lg hover:opacity-90">
                    + Add Department
                </a>
            </div>

            <!-- Search -->
            <input
                v-model="search"
                type="text"
                placeholder="Search by name or code..."
                class="w-full border border-sidebar-border rounded-lg px-4 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
            />

            <!-- Table -->
            <div class="rounded-xl border border-sidebar-border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-muted text-muted-foreground uppercase text-xs">
                        <tr>
                            <th class="text-left px-4 py-3">Name</th>
                            <th class="text-left px-4 py-3">Code</th>
                            <th class="text-left px-4 py-3">Description</th>
                            <th class="text-left px-4 py-3">Status</th>
                            <th class="text-left px-4 py-3">Created</th>
                            <th class="text-left px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Empty state -->
                        <tr v-if="departments.data.length === 0">
                            <td colspan="6" class="text-center py-12 text-muted-foreground">
                                <div class="text-4xl mb-2">🏢</div>
                                <p class="font-medium">No departments found</p>
                                <p class="text-xs mt-1">Try adjusting your search or add a new department.</p>
                            </td>
                        </tr>

                        <tr
                            v-for="dept in departments.data"
                            :key="dept.id"
                            class="border-t border-sidebar-border hover:bg-muted/50 transition"
                        >
                            <td class="px-4 py-3 font-medium">{{ dept.name }}</td>
                            <td class="px-4 py-3 font-mono text-muted-foreground">{{ dept.code }}</td>
                            <td class="px-4 py-3 text-muted-foreground max-w-xs truncate">
                                {{ dept.description ?? '—' }}
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium"
                                    :class="dept.status === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-muted text-muted-foreground'"
                                >
                                    {{ dept.status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-muted-foreground">{{ dept.created_at }}</td>
                            <td class="px-4 py-3 flex gap-3">
                                <a :href="route('departments.show', dept.id)"
                                   class="text-muted-foreground hover:text-primary text-xs">View</a>
                                <a :href="route('departments.edit', dept.id)"
                                   class="text-primary hover:underline text-xs">Edit</a>
                                <button
                                    @click="destroy(dept)"
                                    class="text-destructive hover:underline text-xs"
                                >Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between text-sm text-muted-foreground">
                <span>
                    Showing {{ departments.meta.from ?? 0 }}–{{ departments.meta.to ?? 0 }}
                    of {{ departments.meta.total }}
                </span>
                <div class="flex gap-2">
                    <a
                        v-if="departments.links.prev"
                        :href="departments.links.prev"
                        class="px-3 py-1 border border-sidebar-border rounded hover:bg-muted"
                    >Previous</a>
                    <span class="px-3 py-1">
                        Page {{ departments.meta.current_page }} of {{ departments.meta.last_page }}
                    </span>
                    <a
                        v-if="departments.links.next"
                        :href="departments.links.next"
                        class="px-3 py-1 border border-sidebar-border rounded hover:bg-muted"
                    >Next</a>
                </div>
            </div>

            <!-- Flash -->
            <div
                v-if="page.props.flash?.success"
                class="fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow text-sm"
            >
                {{ page.props.flash.success }}
            </div>

        </div>
    </AppLayout>
</template>
