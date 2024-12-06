<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class customer extends Authenticatable
{
    use Notifiable;

    // Nama tabel (jika berbeda dari default)
    protected $table = 'customer';

    // Field yang bisa diisi
    protected $fillable = ['name', 'age', 'username', 'password', 'role', 'profile_picture'];

    public function getAuthIdentifierName()
    {
        return 'username';
    }


    // Enkripsi password sebelum disimpan

}
