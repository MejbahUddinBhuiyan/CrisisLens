<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'risk_level',
        'description',
        'started_at',
        'ended_at',
        'status',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
            'is_demo' => 'boolean',
        ];
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function forecasts()
    {
        return $this->hasMany(Forecast::class);
    }
}