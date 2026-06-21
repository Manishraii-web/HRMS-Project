export interface DepartmentOption
{
    id: number
    name: string
}

export interface Employee
{
    id : number
    department_id: number
    department: DepartmentOption | null
    user_id: number | null
    employee_code : string | null
    firstname: string | null
    lastname: string | null
    full_name: string | null
    email: string
    phone: string| null
    gender: string | null
    date_of_birth: string| null
    nationality: string| null
    address: string|null
    avatar:string|null
    job_title: string
    employment_type: string|null
    hire_date: string|null
    termination_date: string|null
    status: string
    basic_salary: string
    bank_name:string|null
    bank_account_number: string|null
    nid_number:string|null
    pan_number:string|null
    created_at: string
}

export interface PaginatedEmployees
{
    data: Employee[]
    links: {
        first: string| null
        last: string| null
        prev: string| null
        next: string| null
    }
    meta: {
         current_page: number
        from: number | null
        last_page: number
        per_page: number
        to: number | null
        total: number

    }
}
