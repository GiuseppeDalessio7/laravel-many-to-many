<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'type_id' => 'nullable|exists:types,id',
            'title' => ['required', 'bail', 'min:3', 'max:50',],
            'thumb' => 'nullable|image|max:300',
            'description' => 'nullable|bail|min:3|max:500',
            'github' => 'nullable|bail|min:3|max:2048|url:http,https',
            'r_link' => 'nullable|bail|min:3|max:2048|url:http,https',
            'type_id' => ['nullable', 'exists:types,id'],
        ];
    }
}
