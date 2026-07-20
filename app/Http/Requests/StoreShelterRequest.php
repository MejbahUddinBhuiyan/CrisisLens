<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShelterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('manage shelters') ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'address' => ['required', 'string', 'max:1000'],

            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],

            'capacity' => ['required', 'integer', 'min:0', 'max:100000'],
            'current_occupancy' => ['required', 'integer', 'min:0', 'lte:capacity'],

            'contact_phone' => ['nullable', 'string', 'max:30'],
            'contact_email' => ['nullable', 'email', 'max:150'],

            'status' => ['required', 'string', 'in:available,limited,full,closed'],

            'facilities' => ['nullable', 'array'],
            'facilities.*' => [
                'string',
                'in:drinking_water,toilet,medical_support,women_safe_space,child_support,electricity,food_support,pet_allowed',
            ],

            'is_active' => ['nullable', 'boolean'],
        ];
    }
}