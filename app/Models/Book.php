<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'book_name',
        'book_cat',
        'book_author',
        'book_price',
        'book_desc',
        'book_year',
        'book_country',
        'book_paid_free',
        'book_tag',
        'book_cover_type',
        'book_material_type',
        'book_cover',
        'video_cover',
        'book_material_pdf',
        'book_material_video',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function category(){
        return $this->belongsTo(BookCategory::class, 'book_cat');
    }

    public function material(){
        return $this->belongsTo(BookMaterial::class, 'book_material_type');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'book_country');
    }
}
