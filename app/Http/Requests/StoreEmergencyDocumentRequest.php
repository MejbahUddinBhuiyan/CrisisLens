<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmergencyDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage emergency documents') ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:180'],
            'category' => ['required', 'string', 'max:80'],
            'language' => ['required', 'string', 'in:English,Bangla,English-Bangla'],
            'content' => ['required', 'string', 'min:20'],
            'is_active' => ['nullable', 'boolean'],
            'is_verified' => ['nullable', 'boolean'],
        ];
    }
}