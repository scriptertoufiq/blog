<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'The blog title is required.',
            'title.max'            => 'The blog title must not exceed 255 characters.',
            'description.required' => 'The blog description is required.',
            'image.file'           => 'The image must be a valid file.',
            'image.mimes'          => 'The image must be a file of type: jpg, jpeg, png, webp.',
            'image.max'            => 'The image must not exceed 2MB.',
        ];
    }
}
