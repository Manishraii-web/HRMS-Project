<?php

namespace App\Http\Requests\DepartmentRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends FormRequest
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
        return [
            'tenant_id' => 'required|integer',
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:50',
            // Rule::unique('departments','code')
            // ->where('tenant_id', $this->user()->tenant_id)
            // ->ignore($this->route('departments')), ],
            'status'=> 'nullable|string',
            'description'=> 'nullable|string|max:1300',
         ];
    }
}
