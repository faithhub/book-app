<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;
    protected $table = 'book_categories';
    protected $fillable = [
        'name',
        'status',
        'role',
    ];
    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }
    
}
