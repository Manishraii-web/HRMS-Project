export interface Designation {
    id: number
    name: string
    level: number | null
    description: string | null
    status: 'active' | 'inactive'
    created_at: string
}

export interface PaginatedDepartments {
    data: Designation[]
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
