<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::all();
        return view('admin.config.category', compact('categories'));
    }
    public function store(Request $request){
        $category = new Category;
        $category->category = $request->category;
        $category->save();

        return redirect()->route('categories')->with('success','Categoria criada com sucesso!');
    }
    public function destroy($id){
        Category::findOrFail($id)->delete();

        return redirect()->route('categories')->with('success','Categoria excluida com sucesso!');
    }
}
