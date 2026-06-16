<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    code: '',
    description: '',
    status: 'active',
})

function submit() {
    form.post(route('departments.store'))
}
</script>

<template>
    <div class="p-6 max-w-2xl">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Create Department</h1>
            <p class="text-sm text-gray-500 mt-1">Add a new department to your organisation.</p>
        </div>

        <div class="bg-white border rounded-lg p-6 space-y-5">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Name <span class="text-red-500">*</span>
                </label>
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="e.g. Engineering"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-400': form.errors.name }"
                />
                <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Code <span class="text-red-500">*</span>
                </label>
                <input
                    v-model="form.code"
                    type="text"
                    placeholder="e.g. ENG"
                    class="w-full border rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-400': form.errors.code }"
                />
                <p v-if="form.errors.code" class="text-red-500 text-xs mt-1">{{ form.errors.code }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea
                    v-model="form.description"
                    rows="3"
                    placeholder="Optional description..."
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select
                    v-model="form.status"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button
                    @click="submit"
                    :disabled="form.processing"
                    class="px-5 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 disabled:opacity-50"
                >
                    {{ form.processing ? 'Saving...' : 'Save Department' }}
                </button>

                    :href="route('departments.index')"
                    class="px-5 py-2 border text-sm rounded-lg hover:bg-gray-50 text-gray-600"
                >Cancel</a>
            </div>

        </div>
    </div>
</template>
