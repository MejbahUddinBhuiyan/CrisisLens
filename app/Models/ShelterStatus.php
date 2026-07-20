<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShelterStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'shelter_id',
        'status',
        'available_capacity',
        'occupied_capacity',
        'note',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'available_capacity' => 'integer',
            'occupied_capacity' => 'integer',
        ];
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}