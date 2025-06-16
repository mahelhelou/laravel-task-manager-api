<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title'       => 'sometimes|required|string|max:60',
            'description' => 'sometimes|nullable|string',
            'priority'    => 'sometimes|required|integer|min:1|max:5',
            'user_id'     => 'sometimes|required|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'عنوان المهمة يجب أن يكون من نوع نص.',
            'title.max'    => 'عنوان المهمة يجب أن يكون أقل من ٦٠ حرف.',
            'priority.min' => 'درجة الأهمية لا تقل عن ١.',
            'priority.max' => 'درجة الأهمية لا يجب أن تتجاوز الرقم ٥.',
        ];
    }
}
