<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('publish alerts') ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],

            'risk_level' => ['required', 'string', 'in:Safe,Advisory,Warning,Critical'],
            'status' => ['required', 'string', 'in:draft,published,cancelled'],

            'expires_at' => ['nullable', 'date', 'after:now'],

            'requires_human_approval' => ['nullable', 'boolean'],
            'is_approved' => ['nullable', 'boolean'],
        ];
    }
}