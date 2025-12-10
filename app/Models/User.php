<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'purchaser';
    const ROLE_EDITOR = 'editor';
    const ROLE_AUTHOR = 'author';
    const ROLE_VIEWER = 'viewer';

    public function isPurchaser(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
    public function isPlanner(): bool
    {
        return $this->role === self::ROLE_EDITOR;
    }
    public function isMechanic(): bool
    {
        return $this->role === self::ROLE_AUTHOR;
    }
    public function isUser(): bool
    {
        return $this->role === self::ROLE_VIEWER;
    }

    protected $fillable = [
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
}
