<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){
        return view('admin.products.categories');
    }
}
