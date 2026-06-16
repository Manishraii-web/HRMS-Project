import type { Config } from 'ziggy-js'

declare global {
    function route(): Config
    function route(name: string, params?: unknown, absolute?: boolean): string
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: typeof route
        $page: {
            props: {
                flash: {
                    success: string | null
                    error: string | null
                }
                [key: string]: unknown
            }
        }
    }
}
