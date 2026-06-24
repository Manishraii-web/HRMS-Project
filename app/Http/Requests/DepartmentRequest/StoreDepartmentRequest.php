<?php

namespace App\Http\Requests\DepartmentRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('departments.create');
    }

    public function rules(): array
    {
        $tenantId = $this->user()->tenant_id;
        abort_if(is_null($tenantId), 403, 'No Tenant ID assign to this user');

        return [
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('departments', 'name')->where('tenant_id', $tenantId)->whereNull('deleted_at'),
            ],
            'code' => [
                'required', 'string', 'max:50',
                Rule::unique('departments', 'code')->where('tenant_id', $tenantId)->whereNull('deleted_at'),
            ],
            'status'      => 'nullable|string',
            'description' => 'nullable|string|max:1300',
        ];
    }
}
