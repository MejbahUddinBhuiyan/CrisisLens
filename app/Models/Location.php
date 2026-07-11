<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division',
        'district',
        'upazila',
        'address',
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function shelters()
    {
        return $this->hasMany(Shelter::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function forecasts()
    {
        return $this->hasMany(Forecast::class);
    }

    public function savedLocations()
    {
        return $this->hasMany(SavedLocation::class);
    }
}