<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Sesuaikan nama tabel
    protected $table = 'users';

    // Sesuaikan kolom-kolom yang bisa diisi
    protected $fillable = [
        'username',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true; // created_at & updated_at aktif
}
