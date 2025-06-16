<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone'         => ['sometimes', 'required', 'regex:/^\+?[0-9\s\-]{8,20}$/'],
            'address'       => ['sometimes', 'nullable', 'string', 'max:255'],
            'date_of_birth' => ['sometimes', 'nullable', 'date'],
            'bio'           => ['sometimes', 'nullable', 'string'],
            'user_id'       => ['sometimes', 'required', 'exists:users,id'],
        ];
    }
}
