<?php

namespace App\Http\Requests\DepartmentRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
     /*
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tenantId = Auth::user()->tenant_id;
        $department = $this->route('department');

        return [
            'name' => ['required','string','max:255',
               Rule::unique('departments', 'code')->where('tenant_id', $tenantId)->whereNull('deleted_at')->ignore('department'),
            ],
           'code'        => [
            'required',
            'string',
            'max:50',
            Rule::unique('departments', 'code')->where('tenant_id', $tenantId)->whereNull('deleted_at')->ignore('department'),
        ],
            'status' => 'nullable|string',
            'description' => 'nullable|string|max:1300'
        ];
    }
}
