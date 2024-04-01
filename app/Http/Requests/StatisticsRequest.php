<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatisticsRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]+$/u'],
            'count' => 'required|numeric|regex:/^[0-9]+$/',
            'decay' => 'required|numeric|regex:/^[0-9]+$/',
            'img' => 'required|image|mimes:jpeg,png|max:5120',
        ];
    }
}
