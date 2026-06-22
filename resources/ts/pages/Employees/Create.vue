<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import type { DepartmentOption } from '@/types/employee'

const props = defineProps<{
    departments: DepartmentOption[]
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Employees', href: '/employees' },
    { title: 'Create', href: '/employees/create' },
]

const form = useForm({
    department_id: '',
    employee_code: '',
    firstname: '',
    lastname: '',
    email: '',
    phone: '',
    gender: '',
    date_of_birth: '',
    nationality: '',
    address: '',
    job_title: '',
    employment_type: 'full_time',
    hire_date: '',
    termination_date: '',
    status: 'active',
    basic_salary: '',
    bank_name: '',
    bank_account_number: '',
    nid_number: '',
    pan_number: '',
})

function submit() {
    form.post(route('employees.store'))
}
</script>

<template>
    <Head title="Create Employee" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div>
                <h1 class="text-2xl font-semibold">Create Employee</h1>
                <p class="text-sm text-muted-foreground mt-1">Add a new employee record.</p>
            </div>

            <div class="space-y-6 max-w-2xl">

                <!-- Personal Information -->
                <div class="rounded-xl border border-sidebar-border p-6 space-y-5">
                    <h2 class="text-sm font-semibold text-muted-foreground uppercase">Personal Information</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                First Name <span class="text-destructive">*</span>
                            </label>
                            <input v-model="form.firstname"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="{ 'border-destructive': form.errors.firstname }"
                            />
                            <p v-if="form.errors.firstname" class="text-destructive text-xs mt-1">{{ form.errors.firstname }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Last Name <span class="text-destructive">*</span>
                            </label>
                            <input v-model="form.lastname"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="{ 'border-destructive': form.errors.lastname }"
                            />
                            <p v-if="form.errors.lastname" class="text-destructive text-xs mt-1">{{ form.errors.lastname }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Email <span class="text-destructive">*</span>
                        </label>
                        <input v-model="form.email"
                            type="email"
                            class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            :class="{ 'border-destructive': form.errors.email }"
                        />
                        <p v-if="form.errors.email" class="text-destructive text-xs mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Phone</label>
                            <input v-model="form.phone"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                            <p v-if="form.errors.phone" class="text-destructive text-xs mt-1">{{ form.errors.phone }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Gender</label>
                            <select v-model="form.gender"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                                <option value="">Select...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Date of Birth</label>
                            <input v-model="form.date_of_birth"
                                type="date"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                            <p v-if="form.errors.date_of_birth" class="text-destructive text-xs mt-1">{{ form.errors.date_of_birth }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Nationality</label>
                            <input v-model="form.nationality"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Address</label>
                        <textarea v-model="form.address"
                            rows="2"
                            class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                        />
                    </div>
                </div>

                <!-- Employment Details -->
                <div class="rounded-xl border border-sidebar-border p-6 space-y-5">
                    <h2 class="text-sm font-semibold text-muted-foreground uppercase">Employment Details</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Department <span class="text-destructive">*</span>
                            </label>
                            <select v-model="form.department_id"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="{ 'border-destructive': form.errors.department_id }"
                            >
                                <option value="">Select department...</option>
                                <option v-for="dept in departments" :key="dept.id" :value="dept.id">
                                    {{ dept.name }}
                                </option>
                            </select>
                            <p v-if="form.errors.department_id" class="text-destructive text-xs mt-1">{{ form.errors.department_id }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Employee Code <span class="text-destructive">*</span>
                            </label>
                            <input v-model="form.employee_code"
                                type="text"
                                placeholder="e.g. EMP004"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm font-mono bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="{ 'border-destructive': form.errors.employee_code }"
                            />
                            <p v-if="form.errors.employee_code" class="text-destructive text-xs mt-1">{{ form.errors.employee_code }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Job Title <span class="text-destructive">*</span>
                        </label>
                        <input v-model="form.job_title"
                            type="text"
                            class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            :class="{ 'border-destructive': form.errors.job_title }"
                        />
                        <p v-if="form.errors.job_title" class="text-destructive text-xs mt-1">{{ form.errors.job_title }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Employment Type</label>
                            <select v-model="form.employment_type"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="intern">Intern</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Status</label>
                            <select v-model="form.status"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="terminated">Terminated</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Hire Date <span class="text-destructive">*</span>
                            </label>
                            <input v-model="form.hire_date"
                                type="date"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                                :class="{ 'border-destructive': form.errors.hire_date }"
                            />
                            <p v-if="form.errors.hire_date" class="text-destructive text-xs mt-1">{{ form.errors.hire_date }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Termination Date</label>
                            <input v-model="form.termination_date"
                                type="date"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                            <p v-if="form.errors.termination_date" class="text-destructive text-xs mt-1">{{ form.errors.termination_date }}</p>
                        </div>
                    </div>

                    <div v-if="form.employment_type !== 'intern'">
                        <label class="block text-sm font-medium mb-1">Basic Salary</label>
                        <input v-model="form.basic_salary"
                            type="number"
                            step="0.01"
                            class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                        />
                        <p v-if="form.errors.basic_salary" class="text-destructive text-xs mt-1">{{ form.errors.basic_salary }}</p>
                    </div>
                </div>

                <!-- Banking & Identification -->
                <div v-if="form.employment_type === 'full_time'" class="rounded-xl border border-sidebar-border p-6 space-y-5">
                    <h2 class="text-sm font-semibold text-muted-foreground uppercase">Banking & Identification</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Bank Name</label>
                            <input v-model="form.bank_name"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                            <p v-if="form.errors.bank_name" class="text-destructive text-xs mt-1">{{ form.errors.bank_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Bank Account Number</label>
                            <input v-model="form.bank_account_number"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm font-mono bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                            <p v-if="form.errors.bank_account_number" class="text-destructive text-xs mt-1">{{ form.errors.bank_account_number }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">NID Number</label>
                            <input v-model="form.nid_number"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm font-mono bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">PAN Number</label>
                            <input v-model="form.pan_number"
                                type="text"
                                class="w-full border border-sidebar-border rounded-lg px-3 py-2 text-sm font-mono bg-background focus:outline-none focus:ring-2 focus:ring-primary"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button
                        @click="submit"
                        :disabled="form.processing"
                        class="px-5 py-2 bg-primary text-primary-foreground text-sm rounded-lg hover:opacity-90 disabled:opacity-50"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Employee' }}
                    </button>

                    <a :href="route('employees.index')"
                       class="px-5 py-2 border border-sidebar-border text-sm rounded-lg hover:bg-muted"
                    >Cancel</a>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
