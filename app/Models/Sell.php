<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;
use App\Models\Fpay;

class Sell extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fpay(){
        return $this->belongsTo(Fpay::class);
    }
}
