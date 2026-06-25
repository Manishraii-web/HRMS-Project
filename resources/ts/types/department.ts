export interface Department {
    id: number
    name: string
    code: string
    description: string | null
    status: 'active' | 'inactive'
    employees_count: string
    created_at: string
}

export interface PaginatedDepartments {
    data: Department[]
    links: {
        first: string | null
        last: string | null
        prev: string | null
        next: string | null
    }
    meta: {
        current_page: number
        last_page: number
        per_page: number
        total: number
        from: number | null
        to: number | null
    }
}
