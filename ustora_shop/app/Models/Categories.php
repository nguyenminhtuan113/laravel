<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'status',
        'parent_id'
    ];

    public function children()
    {
        // Quan hệ một menu có thể có nhiều category con
        return $this->hasMany(Categories::class, 'parent_id');
    }
    // Quan hệ một menu có thể là con của một menu khác
    public function parent()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
