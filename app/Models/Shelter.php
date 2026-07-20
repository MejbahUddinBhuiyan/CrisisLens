<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'capacity',
        'current_occupancy',
        'contact_phone',
        'contact_email',
        'facilities',
        'is_active',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'capacity' => 'integer',
            'current_occupancy' => 'integer',
            'facilities' => 'array',
            'is_active' => 'boolean',
            'is_demo' => 'boolean',
        ];
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function statuses()
    {
        return $this->hasMany(ShelterStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(ShelterStatus::class)->latestOfMany();
    }

    public function availableCapacity(): int
    {
        return max(0, $this->capacity - $this->current_occupancy);
    }
}