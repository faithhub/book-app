<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'group_members', 'user_id', 'books', 'plan_id', 'plan', 'plan_start', 'plan_ended',
    ];

    protected $casts = [
        'group_members' => 'array',
        'books' => 'array'
    ];
}
