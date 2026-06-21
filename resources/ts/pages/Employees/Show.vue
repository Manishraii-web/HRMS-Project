<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import type { Employee } from '@/types/employee'

const props = defineProps<{
    employee: Employee
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Employees', href: '/employees' },
    { title: props.employee.full_name || props.employee.email, href: '#' },
]
</script>

<template>
    <Head :title="employee.full_name || employee.email" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">{{ employee.full_name || '—' }}</h1>
                    <p class="text-sm font-mono text-muted-foreground mt-1">{{ employee.employee_code ?? '—' }}</p>
                </div>
                <div class="flex gap-3">
                    <a :href="route('employees.edit', employee.id)"
                       class="px-4 py-2 bg-primary text-primary-foreground text-sm rounded-lg hover:opacity-90">
                        Edit
                    </a>
                    <a :href="route('employees.index')"
                       class="px-4 py-2 border border-sidebar-border text-sm rounded-lg hover:bg-muted">
                        Back
                    </a>
                </div>
            </div>

            <div class="space-y-6 max-w-2xl">

                <!-- Personal Information -->
                <div class="rounded-xl border border-sidebar-border divide-y">
                    <div class="px-6 py-3">
                        <h2 class="text-sm font-semibold text-muted-foreground uppercase">Personal Information</h2>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Email</span>
                        <span class="text-sm">{{ employee.email }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Phone</span>
                        <span class="text-sm">{{ employee.phone ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Gender</span>
                        <span class="text-sm capitalize">{{ employee.gender ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Date of Birth</span>
                        <span class="text-sm">{{ employee.date_of_birth?.slice(0, 10) ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Nationality</span>
                        <span class="text-sm">{{ employee.nationality ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Address</span>
                        <span class="text-sm text-right">{{ employee.address ?? '—' }}</span>
                    </div>
                </div>

                <!-- Employment Details -->
                <div class="rounded-xl border border-sidebar-border divide-y">
                    <div class="px-6 py-3">
                        <h2 class="text-sm font-semibold text-muted-foreground uppercase">Employment Details</h2>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Department</span>
                        <span class="text-sm">{{ employee.department?.name ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Job Title</span>
                        <span class="text-sm">{{ employee.job_title }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Employment Type</span>
                        <span class="text-sm capitalize">{{ employee.employment_type?.replace('_', ' ') ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Status</span>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-medium"
                            :class="employee.status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-muted text-muted-foreground'"
                        >{{ employee.status }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Hire Date</span>
                        <span class="text-sm">{{ employee.hire_date.slice(0, 10) }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Termination Date</span>
                        <span class="text-sm">{{ employee.termination_date?.slice(0, 10) ?? '—' }}</span>
                    </div>
                    <div v-if="employee.employment_type !== 'intern'" class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Basic Salary</span>
                        <span class="text-sm font-mono">{{ employee.basic_salary }}</span>
                    </div>
                </div>

                <!-- Banking & Identification -->
                <div v-if="employee.employment_type === 'full_time'" class="rounded-xl border border-sidebar-border divide-y">
                    <div class="px-6 py-3">
                        <h2 class="text-sm font-semibold text-muted-foreground uppercase">Banking & Identification</h2>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Bank Name</span>
                        <span class="text-sm">{{ employee.bank_name ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">Bank Account Number</span>
                        <span class="text-sm font-mono">{{ employee.bank_account_number ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">NID Number</span>
                        <span class="text-sm font-mono">{{ employee.nid_number ?? '—' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between items-center">
                        <span class="text-sm text-muted-foreground">PAN Number</span>
                        <span class="text-sm font-mono">{{ employee.pan_number ?? '—' }}</span>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
