<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentedBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_id',
        'time_borroewd',
        'return_time',
        'rated',
        'rated_point',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function rate()
    {
        return $this->hasOne(Rate::class, 'book_id', 'book_id');
    }
}
