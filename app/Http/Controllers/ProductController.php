<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products(){
        $products = Product::orderBy('id', 'desc')->get();
        $category = Category::all();

        return view('admin.products.products', ['products'=> $products, 'category'=> $category]);
    }
    public function store(Request $request){
        $products = new Product;

         $request->validate([
             'name'=>'required',            
             'description'=>'required',
             'provider'=>'required',
             'brand'=>'required',
             'category_id'=>'required'            
         ]);

        $products->name = $request->name;
        $products->description = $request->description;
        $products->provider = $request->provider;
        $products->brand = $request->brand;
        $products->category_id = $request->category_id;
        $products->save();

        return redirect()->route('products')->with('success', 'Produto cadastrado com sucesso!');
    }

}
