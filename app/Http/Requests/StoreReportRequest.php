<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('submit report') ?? false;
    }

    public function rules(): array
    {
        return [
            'category' => ['required', 'string', 'max:100'],
            'urgency' => ['required', 'string', 'in:low,medium,high,critical'],
            'description' => ['required', 'string', 'min:10', 'max:3000'],

            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],

            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }
}