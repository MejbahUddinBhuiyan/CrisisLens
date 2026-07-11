<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function reports()
{
    return $this->hasMany(Report::class);
}

public function validatedReports()
{
    return $this->hasMany(Report::class, 'validated_by');
}

public function savedLocations()
{
    return $this->hasMany(SavedLocation::class);
}

public function alertPreference()
{
    return $this->hasOne(AlertPreference::class);
}

public function publishedAlerts()
{
    return $this->hasMany(Alert::class, 'published_by');
}

public function approvedAlerts()
{
    return $this->hasMany(Alert::class, 'approved_by');
}

public function uploadedEmergencyDocuments()
{
    return $this->hasMany(EmergencyDocument::class, 'uploaded_by');
}
}