<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title'       => 'required|string|max:60',
            'description' => 'string|nullable',
            'priority'    => 'required|integer|min:1|max:5',
            'user_id'     => 'required|exists:users,id',
        ];

    }

    // Customize error messages
    public function messages(): array
    {
        return [
            'title.required'    => 'الرجاء إدخال عنوان المهمة.',
            'title.string'      => 'عنوان المهمة يجب أن يكون من نوع نص.',
            'title.max'         => 'عنوان المهمة يجب أن يكون أقل من ٦٠ حرف.',
            'priority.required' => 'الرجاء اختيار درجة الأهمية بالأرقام',
            'priority.min'      => 'درجة الأهمية لا تقل عن ١.',
            'priority.max'      => 'درجة الأهمية لا يجب أن تتجاوز الرقم ٥.',
        ];
    }
}
