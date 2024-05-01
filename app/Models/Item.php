<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

   protected $fillable = ['name', 'price', 'total', 'image', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function receipts()
    {
        return $this->belongsToMany(Receipt::class)->withPivot('total_items');
    }
}
