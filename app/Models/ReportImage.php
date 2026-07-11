<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'disk',
        'path',
        'original_name',
        'mime_type',
        'size',
        'is_analyzed',
        'ai_damage_label',
        'ai_confidence_score',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'is_analyzed' => 'boolean',
            'ai_confidence_score' => 'decimal:4',
        ];
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function predictions()
    {
        return $this->morphMany(Prediction::class, 'predictable');
    }
}