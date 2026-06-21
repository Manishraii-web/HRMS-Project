<?php

namespace App\Http\Requests\Employee;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tenantId = $this->user()->tenant_id;
        $employee = $this->route('employee');
        abort_if(is_null($tenantId), 403, 'No tenant_id found...');
        return [
            'department_id' =>[
                'required','integer',
                Rule::exists('departments','id')->where('tenant_id', $tenantId)->whereNull('deleted_at'),
        ],
        'user_id' => 'nullable|integer|exists:users,id',

        'employee_code' => [
            'required','string','max:35',
            Rule::unique('employees','employee_code')->where('tenant_id',$tenantId)->whereNull('deleted_at')->ignore($employee),
        ],
         'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                'max:120',
                Rule::unique('employees', 'email')->where('tenant_id', $tenantId)->whereNull('deleted_at')->ignore($employee),
            ],

            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:male,female,others',
            'date_of_birth' => 'required|string|before:today',
            'nationality' => 'required|string',
            'address' => 'required|string|max:150',
            'avatar' => 'nullable|string|max:200',
            'job_title' => 'required|string|max:100',
            'employment_type' => 'required|string|in:full_time,part_time,intern,contract',
            'hire_date' => 'required|date',
            'termination_date' => 'nullable|date|after_or_equal:hire_date',
            'status' => 'required|string|in:active,inactive,terminated',
            'basic_salary' => 'nullable|numeric|min:0',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:30',
            'nid_number' => 'nullable|string',
            'pan_number' => 'nullable|string|max:100',


        ];
    }
}
