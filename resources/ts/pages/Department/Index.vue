<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import type { PaginatedDepartments } from '@/types/department'

const props = defineProps<{
    departments: PaginatedDepartments
    filters: { search: string }
}>()

const search = ref(props.filters.search)

watch(search, (value) => {
    router.get(route('departments.index'), { search: value }, {
        preserveState: true,
        replace: true,
    })
})

function destroy(id: number) {
    if (!confirm('Are you sure you want to delete this department?')) return
    router.delete(route('departments.destroy', id))
}
</script>

<template>
    <div class="p-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Departments</h1>
                <p class="text-sm text-gray-500 mt-1">
                    {{ departments.meta.total }} department{{ departments.meta.total !== 1 ? 's' : '' }} total
                </p>
            </div>
            <a :href="route('departments.create')"
               class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                + Add Department
            </a>
        </div>

        <!-- Search -->
        <input
            v-model="search"
            type="text"
            placeholder="Search by name or code..."
            class="mb-4 w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <!-- Table -->
        <div class="border rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
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
                        <td colspan="6" class="text-center py-12 text-gray-400">
                            <div class="text-4xl mb-2">🏢</div>
                            <p class="font-medium">No departments found</p>
                            <p class="text-xs mt-1">Try adjusting your search or add a new department.</p>
                        </td>
                    </tr>

                   <!-- how it is dept.id -->
                    <tr
                        v-for="dept in departments.data"
                        :key="dept.id"
                        class="border-t hover:bg-gray-50 transition"
                    >
                        <td class="px-4 py-3 font-medium text-gray-900">{{ dept.name }}</td>
                        <td class="px-4 py-3 text-gray-600 font-mono">{{ dept.code }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-xs truncate">
                            {{ dept.description ?? '—' }}
                        </td>
                        <td class="px-4 py-3">
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium"
                                :class="dept.status === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-500'"
                            >
                                {{ dept.status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ dept.created_at }}</td>
                        <td class="px-4 py-3 flex gap-3">
                            <a :href="route('departments.show', dept.id)"
                               class="text-gray-500 hover:text-blue-600 text-xs">View</a>
                            <a :href="route('departments.edit', dept.id)"
                               class="text-blue-600 hover:underline text-xs">Edit</a>
                            <button
                                @click="destroy(dept.id)"
                                class="text-red-500 hover:underline text-xs"
                            >Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
            <span>
                Showing {{ departments.meta.from ?? 0 }}–{{ departments.meta.to ?? 0 }}
                of {{ departments.meta.total }}
            </span>
            <div class="flex gap-2">

                    v-if="departments.links.prev"
                    :href="departments.links.prev"
                    class="px-3 py-1 border rounded hover:bg-gray-100"
                >Previous</a>
                <span class="px-3 py-1 text-gray-400">
                    Page {{ departments.meta.current_page }} of {{ departments.meta.last_page }}
                </span>

                    v-if="departments.links.next"
                    :href="departments.links.next"
                    class="px-3 py-1 border rounded hover:bg-gray-100"
                >Next</a>
            </div>
        </div>

        <!-- Flash message -->
        <div
            v-if="$page.props.flash?.success"
            class="fixed bottom-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow text-sm"
        >
            {{ $page.props.flash.success }}
        </div>

    </div>
</template>
