declare module '@inertiajs/vue3' {
    interface PageProps {
        flash: {
            success: string | null
            error: string | null
        }
        auth: {
            user: import('@/types').User
        }
        [key: string]: unknown
    }
}

export {}
