<?php

namespace App\Http\Requests\Designation;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDesignationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return $this->user()->can('designations.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name' => ['required','string','max:100',
              Rule::unique('designations')->where('tenant_id', $this->user()->tenant_id)->whereNull('deleted_at')->ignore($this->route('designation')),
             ],
            'level' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:active,inactive'
        ];
    }
}
