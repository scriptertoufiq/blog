<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $studentId = $this->route('student')?->id;

        return [
            'name'       => ['required', 'string', 'max:255'],
            'roll'       => ['required', 'string', 'max:50', "unique:students,roll,{$studentId}"],
            'fathername' => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', "unique:students,email,{$studentId}"],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'       => 'Student name is required.',
            'roll.required'       => 'Roll number is required.',
            'roll.unique'         => 'This roll number is already taken.',
            'fathername.required' => "Father's name is required.",
            'email.required'      => 'Email address is required.',
            'email.email'         => 'Please provide a valid email address.',
            'email.unique'        => 'This email address is already registered.',
        ];
    }
}
