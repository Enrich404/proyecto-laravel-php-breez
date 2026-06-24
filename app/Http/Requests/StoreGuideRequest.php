<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGuideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1500'],
            'category' => ['required', 'string', 'max:80'],
            'visibility' => ['required', Rule::in(['public', 'private'])],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240', 'required_without:images'],
            'images' => ['nullable', 'array', 'required_without:pdf'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ];
    }
}
