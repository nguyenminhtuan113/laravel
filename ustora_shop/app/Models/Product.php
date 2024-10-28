<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'discount',
        'price',
        'category_id',
        'description',
        'tag',
        'slug',
        'img',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function imgProduct()
    {
        return $this->hasMany(ImgProduct::class, 'product_id');
    }
}
