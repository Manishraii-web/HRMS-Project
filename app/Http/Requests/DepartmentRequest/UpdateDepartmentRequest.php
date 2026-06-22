<?php

namespace App\Http\Requests\DepartmentRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

      public function rules(): array
    {

        $tenantId = $this->user()->tenant_id;
        $department = $this->route('department');
        abort_if(is_null($tenantId), 403, 'No Tenant ID assign to this user');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->where('tenant_id', $tenantId)->whereNull('deleted_at')->ignore($department),
            ],
            'code'        => [
                'required',
                'string',
                'max:50',
                Rule::unique('departments', 'code')->where('tenant_id', $tenantId)->whereNUll('deleted_at')->ignore($department),
            ],
            'status' => 'nullable|string',
            'description' => 'nullable|string|max:1300'
        ];
    }
}
