<?php

namespace App\Http\Controllers;

use App\Models\AllLogInventory;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function inventory(){
        $products = Product::all();
        $inventory = Inventory::all();

        return view('admin.inventory.inventory', ['inventory'=>$inventory, 'products'=>$products]);
    }
    public function store(Request $request){
        
            $inventory = Inventory::find($request->product_id); 
            if(isset($inventory) || !empty($inventory)){                                
                $inventory->qtd += $request->qtd;
                $inventory->price_buy = ($inventory->price_buy + str_replace(",", ".", $request->price_buy)) / 2;                
                $inventory->update();

                $allInventory = new AllLogInventory;
                $allInventory->product_id = $request->product_id;
                $allInventory->unit = $request->unit;
                $allInventory->qtd = $request->qtd;
                $allInventory->price_buy = str_replace(",", ".", $request->price_buy);
                $allInventory->total_price = $allInventory->qtd * $allInventory->price_buy;
                $allInventory->save();
                
                return redirect()->route('inventory')->with('success', 'Item lançado com sucesso!');                
            }

            $inventory = new Inventory;
            $inventory->product_id = $request->product_id;
            $inventory->unit = $request->unit;
            $inventory->qtd = $request->qtd;
            $inventory->price_buy = str_replace(",", ".", $request->price_buy);            
            $inventory->save();

            $allInventory = new AllLogInventory;
            $allInventory->product_id = $request->product_id;
            $allInventory->unit = $request->unit;
            $allInventory->qtd = $request->qtd;
            $allInventory->price_buy = str_replace(",", ".", $request->price_buy);
            $allInventory->total_price = $allInventory->qtd * $allInventory->price_buy;
            $allInventory->save();

            return redirect()->route('inventory')->with('success', 'Item lançado com sucesso!');

    }
}
