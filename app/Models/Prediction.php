<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'predictable_type',
        'predictable_id',
        'prediction_type',
        'prediction',
        'confidence_score',
        'model_version',
        'processing_timestamp',
        'input_data_source',
        'input_payload',
        'raw_response',
        'human_review_status',
        'reviewed_by',
        'reviewed_at',
        'review_note',
        'is_demo',
    ];

    protected function casts(): array
    {
        return [
            'confidence_score' => 'decimal:4',
            'processing_timestamp' => 'datetime',
            'input_payload' => 'array',
            'raw_response' => 'array',
            'reviewed_at' => 'datetime',
            'is_demo' => 'boolean',
        ];
    }

    public function predictable()
    {
        return $this->morphTo();
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}