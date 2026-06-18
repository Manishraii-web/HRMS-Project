<?php

namespace App\DTOs;

class EmployeeDTO {
    public function __construct(
        public readonly int $departmentId,
        public readonly string $email,
        public readonly string $jobTitle,
        public readonly string $hireDate,
        public readonly ?int $userId =null,
        public readonly ?string $employeeCode =null,
        public readonly ?string $firstname =null,
        public readonly ?string $lastname =null,
        public readonly ?string $phone =null,
        public readonly ?string $gender =null,
        public readonly ?string $dateOfBirth =null,
        public readonly ?string $nationality =null,
        public readonly ?string $address =null,
        public readonly ?string $avatar =null,
        public readonly ?string $employmentType =null,
        public readonly ?string $terminationDate =null,
        public readonly ?string $status ='active',
        public readonly ?float $basicSalary = 0,
        public readonly ?string $bankName = null,
        public readonly ?string $bankAccountNumber = null,
        public readonly ?string $nidNumber = null,
        public readonly ?string $panNumber = null,
        public readonly ?int $tenantId = null,


    ) {}
    public static function fromArray(array $data):self
    {
       return new self(
        departmentId: $data['department_id'],
        email: $data['email'],
        jobTitle: $data['job_title'],
        hireDate: $data['hire_date'],
        userId: $data['user_id']?? null,
        employeeCode: $data['employee_code'] ?? null,
        firstname: $data['first_name']?? null,
        lastname: $data['last_name']?? null,
        phone: $data['phone']?? null,
        gender: $data['gender'] ?? null,
        dateOfBirth: $data['date_of_birth'] ?? null,
        nationality: $data['nationality'] ?? null,
        address: $data['address'] ?? null,
        avatar: $data['avatar'] ?? null,
        employmentType: $data['employment_type'] ?? null,
        terminationDate: $data['termination_date'] ?? null,
        status: $data['status'] ?? null,
        bankName: $data['bank_name'] ?? null,
        bankAccountNumber: $data['bank_account_number'] ?? null,
        nidNumber: $data['nid_number'] ?? null,
        panNumber: $data['pan_number'] ?? null,
        tenantId: $data['tenant_id'] ?? null,

       );
    }
      public function toArray(): array
    {
        return [
            'department_id'       => $this->departmentId,
            'user_id'             => $this->userId,
            'employee_code'       => $this->employeeCode,
            'firstname'           => $this->firstname,
            'lastname'            => $this->lastname,
            'email'               => $this->email,
            'phone'               => $this->phone,
            'gender'              => $this->gender,
            'date_of_birth'       => $this->dateOfBirth,
            'nationality'         => $this->nationality,
            'address'             => $this->address,
            'avatar'              => $this->avatar,
            'job_title'           => $this->jobTitle,
            'employment_type'     => $this->employmentType,
            'hire_date'           => $this->hireDate,
            'termination_date'    => $this->terminationDate,
            'status'              => $this->status,
            'basic_salary'        => $this->basicSalary,
            'bank_name'           => $this->bankName,
            'bank_account_number' => $this->bankAccountNumber,
            'nid_number'          => $this->nidNumber,
            'pan_number'          => $this->panNumber,
        ];
}

}
