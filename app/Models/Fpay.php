<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sell;
use App\Models\Budget;

class Fpay extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sells(){
        return $this->hasMany(Sell::class);
    }
    // Orçamento
    public function budgets(){
        return $this->hasMany(Budget::class);
    }
}
