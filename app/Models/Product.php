<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'sku',
        'product_name',
        'sell_price',
    ];

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function getCurrentStockAttribute()
    {
        $in = $this->stocks()->where('type', 'in')->sum('quantity');
        $out = $this->stocks()->where('type', 'out')->sum('quantity');

        return $in - $out;
    }
}
