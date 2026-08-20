<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'uploaded_by',
        'title',
        'language',
        'category',
        'disk',
        'path',
        'content',
        'is_verified',
        'is_active',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'is_demo' => 'boolean',
        ];
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}