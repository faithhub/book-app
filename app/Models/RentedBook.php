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
    ];

    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }
}
