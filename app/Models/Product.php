<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\AllLogInventory;
use App\Models\Sell;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function inventories(){
        return $this->hasMany(Inventory::class);
    }  
    public function allLogInventories(){
        return $this->hasMany(AllLogInventory::class);
    }
    public function sell(){
        return $this->hasMany(Sell::class);
    }   
}
