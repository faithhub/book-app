<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'book_name',
        'book_cat',
        'book_author',
        'book_price',
        'book_rent',
        'book_desc',
        'book_pdf',
    ];
}
