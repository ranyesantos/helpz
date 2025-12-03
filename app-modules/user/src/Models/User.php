<?php

namespace Helpz\User\Models;

use Helpz\ServiceRequest\Models\ServiceRequest;
use Helpz\User\Enums\UserRolesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Helpz\User\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @method bool isAdmin()
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(UserRolesEnum::Admin);
    }

    /**
     * @method bool isTechnician()
     */
    public function isTechnician(): bool
    {
        return $this->hasRole(UserRolesEnum::Technician);
    }
    
    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
