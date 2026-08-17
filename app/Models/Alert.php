<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'disaster_id',
        'location_id',
        'published_by',
        'title',
        'message',
        'risk_level',
        'status',
        'requires_human_approval',
        'is_approved',
        'approved_by',
        'approved_at',
        'published_at',
        'expires_at',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'requires_human_approval' => 'boolean',
            'is_approved' => 'boolean',
            'approved_at' => 'datetime',
            'published_at' => 'datetime',
            'expires_at' => 'datetime',
            'is_demo' => 'boolean',
        ];
    }

    public function disaster()
    {
        return $this->belongsTo(Disaster::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isActive(): bool
    {
        return $this->status === 'published'
            && $this->published_at !== null
            && ($this->expires_at === null || $this->expires_at->isFuture());
    }
}