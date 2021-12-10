<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Vendor extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'mobile',
        'dob',
        'gender',
        'bank',
        'acc_number',
        'acc_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
