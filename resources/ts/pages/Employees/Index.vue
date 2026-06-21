<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, usePage} from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import type { BreadcrumbItem } from '@/types';
import type { PaginatedEmployees, DepartmentOption } from '@/types/employee';
import { Search } from 'lucide-vue-next';

const page = usePage()

const props = defineProps<{
    employees: PaginatedEmployees
    departments: DepartmentOption[]
    filters: { search: string; department_id: string}
}>()

const breadcrumbs: BreadcrumbItem[] =[
    {title: '/Dashboard', href: '/dashboard' },
    {title: '/Employees', href:'/employees'},
]

const search = ref(props.filters.search)
const departmentFilter= ref(props.filters.department_id)

watch([search,departmentFilter], ([searchVal, deptVal]) =>{
    router.get(route('employees.index'), {
        search: searchVal,
        department_id: deptVal,
    }, {
        preserveState: true,
        replace: true

    })
})

function destroy(id: number) {
    if( !confirm('You sure want to delete this Employee ?')) return
    router.delete(route('employees.destroy', id))
}

</script>

<template>
    <Head title="Employees" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">Employees</h1>
                    <p class="text-sm text-muted-foreground mt-1">
                        {{ employees.meta.total }} employee{{ employees.meta.total !== 1 ? 's' : '' }} total
                    </p>
                </div>
                <a :href="route('employees.create')"
                   class="px-4 py-2 bg-primary text-primary-foreground text-sm rounded-lg hover:opacity-90">
                    + Add Employee
                </a>
            </div>

            <!-- Search + Filter -->
            <div class="flex gap-3">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search by name, code, or email..."
                    class="flex-1 border border-sidebar-border rounded-lg px-4 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                />
                <select
                    v-model="departmentFilter"
                    class="border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                >
                    <option value="">All Departments</option>
                    <option v-for="dept in departments" :key="dept.id" :value="dept.id">
                        {{ dept.name }}
                    </option>
                </select>
            </div>

            <!-- Table -->
            <div class="rounded-xl border border-sidebar-border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-muted text-muted-foreground uppercase text-xs">
                        <tr>
                            <th class="text-left px-4 py-3">Code</th>
                            <th class="text-left px-4 py-3">Name</th>
                            <th class="text-left px-4 py-3">Department</th>
                            <th class="text-left px-4 py-3">Job Title</th>
                            <th class="text-left px-4 py-3">Status</th>
                            <th class="text-left px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="employees.data.length === 0">
                            <td colspan="6" class="text-center py-12 text-muted-foreground">
                                <div class="text-4xl mb-2">👤</div>
                                <p class="font-medium">No employees found</p>
                                <p class="text-xs mt-1">Try adjusting your search or add a new employee.</p>
                            </td>
                        </tr>

                        <tr
                            v-for="emp in employees.data"
                            :key="emp.id"
                            class="border-t border-sidebar-border hover:bg-muted/50 transition"
                        >
                            <td class="px-4 py-3 font-mono text-muted-foreground">{{ emp.employee_code ?? '—' }}</td>
                            <td class="px-4 py-3 font-medium">{{ emp.full_name || '—' }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ emp.department?.name ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ emp.job_title }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium"
                                    :class="emp.status === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-muted text-muted-foreground'"
                                >
                                    {{ emp.status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 flex gap-3">
                                <a :href="route('employees.show', emp.id)"
                                   class="text-muted-foreground hover:text-primary text-xs">View</a>
                                <a :href="route('employees.edit', emp.id)"
                                   class="text-primary hover:underline text-xs">Edit</a>
                                <button
                                    @click="destroy(emp.id)"
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
                    Showing {{ employees.meta.from ?? 0 }}–{{ employees.meta.to ?? 0 }}
                    of {{ employees.meta.total }}
                </span>
                <div class="flex gap-2">
                        <a
                        v-if="employees.links.prev"
                        :href="employees.links.prev"
                        class="px-3 py-1 border border-sidebar-border rounded hover:bg-muted"
                 >Previous</a>
                    <span class="px-3 py-1">
                        Page {{ employees.meta.current_page }} of {{ employees.meta.last_page }}
                    </span>
                          <a
                        v-if="employees.links.next"
                        :href="employees.links.next"
                        class="px-3 py-1 border border-sidebar-border rounded hover:bg-muted"
                  > Next</a>
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
