<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Sell;

class Inventory extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
