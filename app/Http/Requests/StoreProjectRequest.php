<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => ['required', 'min:5', 'max:50'],
            'description' => ['nullable'],
            'cover_image' => ['nullable', 'image', 'max:1000', 'mimes:png,jpg'],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => 'nullable|exists:technologies,id',
            'github' => 'nullable|bail|min:3|max:2048|url:http,https',
            'r_link' => 'nullable|bail|min:3|max:2048|url:http,https',
        ];
    }
}
