<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'assignee' => 'nullable|string|max:255',
            'due_date' => 'required|date|after_or_equal:today',
            'time_tracked' => 'nullable|integer|min:0',
            'status' => 'nullable|in:pending,open,in_progress,completed',
            'priority' => 'nullable|in:low,medium,high',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->input('status') === null) {
            $this->merge([
                'status' => 'pending',
            ]);
        }
    }
}
