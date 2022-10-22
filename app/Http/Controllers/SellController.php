<?php

namespace App\Http\Controllers;

use App\Exports\SellExport;
use App\Models\CardTariff;
use App\Models\Fpay;
use App\Models\Inventory;
use App\Models\Sell;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SellController extends Controller
{
    public function sell(){
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();
        return view('admin.sell.sell',['inventory'=>$inventory, 'fpay'=>$fpay, 'cardTariff'=>$cardTariff]);
    }
    public function store(Request $request){
    
        $sell = new Sell;
        $sell->client = $request->client;
        $sell->contact = $request->contact; 
        $sell->product_1_id = $request->product_1_id;
        $sell->product_1_qtd = $request->product_1_qtd;
        $sell->product_2_id = $request->product_2_id;
        $sell->product_2_qtd = $request->product_2_qtd;
        $sell->product_3_id = $request->product_3_id;
        $sell->product_3_qtd = $request->product_3_qtd;
        $sell->product_4_id = $request->product_4_id;
        $sell->product_4_qtd = $request->product_4_qtd;
        $sell->product_5_id = $request->product_5_id;
        $sell->product_5_qtd = $request->product_5_qtd;
        $sell->product_6_id = $request->product_6_id;
        $sell->product_6_qtd = $request->product_6_qtd;
        $sell->product_7_id = $request->product_7_id;
        $sell->product_7_qtd = $request->product_7_qtd;
        $sell->product_8_id = $request->product_8_id;
        $sell->product_8_qtd = $request->product_8_qtd;
        $sell->product_9_id = $request->product_9_id;
        $sell->product_9_qtd = $request->product_9_qtd;
        $sell->fpay_id = $request->fpay_id;
        $sell->document = $request->document;
        $sell->description_service = $request->description_service;
        $sell->price = str_replace(",", ".", $request->price);
        $sell->labor = str_replace(",", ".", $request->labor);
        $sell->discount = str_replace(",", ".", $request->discount);
        $sell->tariff = $request->cardTariff;
        $total= $sell->price + $sell->labor - $sell->discount;
        if($request->fpay_id == 1){
            $percentual =  $total * ($request->cardTariff / 100); 
            $sell->total = $total - $percentual;
        }else{
            $sell->total = $total;
        }
    
        if(isset($sell->product_1_id) && !empty($sell->product_1_id)){
            $inventory = Inventory::find($sell->product_1_id);
            $inventory->qtd -= $sell->product_1_qtd;
            $inventory->update();
        }
        if(isset($sell->product_2_id) && !empty($sell->product_2_id)){
            $inventory = Inventory::find($sell->product_2_id);
            $inventory->qtd -= $sell->product_2_qtd;
            $inventory->update();
        }
        if(isset($sell->product_3_id) && !empty($sell->product_3_id)){
            $inventory = Inventory::find($sell->product_3_id);
            $inventory->qtd -= $sell->product_3_qtd;
            $inventory->update();
        }
        if(isset($sell->product_4_id) && !empty($sell->product_4_id)){
            $inventory = Inventory::find($sell->product_4_id);
            $inventory->qtd -= $sell->product_4_qtd;
            $inventory->update();
        }
        if(isset($sell->product_5_id) && !empty($sell->product_5_id)){
            $inventory = Inventory::find($sell->product_5_id);
            $inventory->qtd -= $sell->product_5_qtd;
            $inventory->update();
        }
        if(isset($sell->product_6_id) && !empty($sell->product_6_id)){
            $inventory = Inventory::find($sell->product_6_id);
            $inventory->qtd -= $sell->product_6_qtd;
            $inventory->update();
        }
        if(isset($sell->product_7_id) && !empty($sell->product_7_id)){
            $inventory = Inventory::find($sell->product_7_id);
            $inventory->qtd -= $sell->product_7_qtd;
            $inventory->update();
        }
        if(isset($sell->product_8_id) && !empty($sell->product_8_id)){
            $inventory = Inventory::find($sell->product_8_id);
            $inventory->qtd -= $sell->product_8_qtd;
            $inventory->update();
        }
        if(isset($sell->product_9_id) && !empty($sell->product_9_id)){
            $inventory = Inventory::find($sell->product_9_id);
            $inventory->qtd -= $sell->product_9_qtd;
            $inventory->update();
        }
        $sell->save();

        return redirect()->route('sell')->with('success', 'Venda lançada com sucesso!');
    }
    public function relatory(){
        $sell = Sell::orderBy('id', 'desc')->get();        
        $inventory = Inventory::all();
        $tariff = CardTariff::all();
        return view('admin.relatory.relatory',['sell'=>$sell, 'inventory'=>$inventory, 'tariff'=>$tariff]);
    }
    public function pdf(){
        $sell = Sell::all();
        $inventory = Inventory::all();
        $product = Product::all();
        $tariff = CardTariff::all();
        $pdf = pdf::loadView('admin.sell.sellpdf', compact('tariff', 'sell', 'inventory', 'product'));
        return $pdf->setPaper('a4')->stream("Resumo de Vendas");
    }
    public function excel(){
        return Excel::download(new SellExport, 'resumovendas.xlsx');
    }
}
