<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description', 'date_time'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
