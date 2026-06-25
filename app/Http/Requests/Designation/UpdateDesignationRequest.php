<?php

namespace App\Http\Requests\Designation;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDesignationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('departments.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name' => 'required|string|max:100',
            'level' => 'sometimes|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'status' => 'sometimes|string|in:active,inactive'
        ];
    }
}
