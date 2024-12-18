<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customer';

    protected $fillable = ['name', 'age', 'username', 'password', 'role', 'profile_picture'];

    // Use Laravel's default identifier name
    // Remove this if unnecessary
    public function getAuthIdentifierName()
    {
        return 'id'; // or the default 'email' if necessary
    }

    // Ensure the password is always encrypted
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (!empty($customer->password)) {
                $customer->password = bcrypt($customer->password);
            }
        });
    }
}
