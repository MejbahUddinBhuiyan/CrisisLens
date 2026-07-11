<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'disaster_id',
        'location_id',
        'category',
        'urgency',
        'status',
        'description',
        'latitude',
        'longitude',
        'is_verified',
        'validated_by',
        'validated_at',
        'validation_note',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_verified' => 'boolean',
            'validated_at' => 'datetime',
            'is_demo' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disaster()
    {
        return $this->belongsTo(Disaster::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->hasMany(ReportImage::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function predictions()
    {
        return $this->morphMany(Prediction::class, 'predictable');
    }
}