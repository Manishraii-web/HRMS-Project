<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
     public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'department_id' => $this->department_id,
            'department' => $this->whenLoaded('department', fn() => [
                'id' => $this->department->id,
                'name' => $this->department->name,
            ]),
            'user_id' => $this->user_id,
            'employee_code' => $this->employee_code,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'full_name' => trim("{$this->firstname} {$this->lastname}"),
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth?->format('Y-m-d'),
            'nationality' => $this->nationality,
            'address'     => $this->address,
            'avatar'     => $this->avatar,
            'job_title'    => $this->job_title,
            'employment_type' => $this->employment_type,
            'hire_date'      => $this->hire_date?->format('Y-m-d'),
            'termination_date' => $this->termination_date?->format('Y-m-d'),
            'status'        => $this->status,
            'basic_salary'   => $this->basic_salary,
            'bank_name'     => $this->bank_name,
            'bank_account_number' => $this->bank_account_number,
            'nid_number'    => $this->nid_number,
            'pan_number'    => $this->pan_number,
            'created_at'    => $this->created_at,


        ];
    }
}
