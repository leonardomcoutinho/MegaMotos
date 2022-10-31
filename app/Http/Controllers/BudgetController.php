<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\CardTariff;
use App\Models\Fpay;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Sell;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BudgetController extends Controller
{
    public function read(){
        $budget = Budget::orderBy('id', 'desc')->paginate(5);
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $tariff = CardTariff::all();
        return view('admin.budget.read', compact('budget', 'inventory', 'tariff', 'fpay'));
    }
    public function budget(){
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();
        return view('admin.budget.budget',['inventory'=>$inventory, 'fpay'=>$fpay, 'cardTariff'=>$cardTariff]);
    }
    public function store(Request $request){
    
        $budget = new Budget;
        $budget->client = $request->client;
        $budget->contact = $request->contact;        
        $budget->product_1_id = $request->product_1_id;
        $budget->product_1_qtd = $request->product_1_qtd;
        if($request->product_1_value){
            $budget->product_1_value = str_replace(",", ".", $request->product_1_value);
        }else{
            $budget->product_1_value = 0.00;
        }
        $budget->product_2_id = $request->product_2_id;
        $budget->product_2_qtd = $request->product_2_qtd;
        if($request->product_2_value){
            $budget->product_2_value = str_replace(",", ".", $request->product_2_value);
        }else{
            $budget->product_2_value = 0.00;
        }
        $budget->product_3_id = $request->product_3_id;
        $budget->product_3_qtd = $request->product_3_qtd;
        if($request->product_3_value){
            $budget->product_3_value = str_replace(",", ".", $request->product_3_value);
        }else{
            $budget->product_3_value = 0.00;
        }
        $budget->product_4_id = $request->product_4_id;
        $budget->product_4_qtd = $request->product_4_qtd;
        if($request->product_4_value){
            $budget->product_4_value = str_replace(",", ".", $request->product_4_value);
        }else{
            $budget->product_4_value = 0.00;
        }
        $budget->product_5_id = $request->product_5_id;
        $budget->product_5_qtd = $request->product_5_qtd;
        if($request->product_5_value){
            $budget->product_5_value = str_replace(",", ".", $request->product_5_value);
        }else{
            $budget->product_5_value = 0.00;
        }
        $budget->product_6_id = $request->product_6_id;
        $budget->product_6_qtd = $request->product_6_qtd;
        if($request->product_6_value){
            $budget->product_6_value = str_replace(",", ".", $request->product_6_value);
        }else{
            $budget->product_6_value = 0.00;
        }
        $budget->product_7_id = $request->product_7_id;
        $budget->product_7_qtd = $request->product_7_qtd;
        if($request->product_7_value){
            $budget->product_7_value = str_replace(",", ".", $request->product_7_value);
        }else{
            $budget->product_7_value = 0.00;
        }
        $budget->product_8_id = $request->product_8_id;
        $budget->product_8_qtd = $request->product_8_qtd;
        if($request->product_8_value){
            $budget->product_8_value = str_replace(",", ".", $request->product_8_value);
        }else{
            $budget->product_8_value = 0.00;
        }
        $budget->product_9_id = $request->product_9_id;
        $budget->product_9_qtd = $request->product_9_qtd;
        if($request->product_9_value){
            $budget->product_9_value = str_replace(",", ".", $request->product_9_value);
        }else{
            $budget->product_9_value = 0.00;
        }        
        $budget->description_service = $request->description_service;
        $budget->status = "Pendente";
        $budget->price = str_replace(",", ".", $request->price);
        $budget->labor = str_replace(",", ".", $request->labor);
        $budget->discount = str_replace(",", ".", $request->discount);
        $budget->tariff = $request->cardTariff;
        $total= $budget->price + $budget->labor - $budget->discount;
        $budget->total = $total;
         
        
        $budget->save();

        return redirect()->route('read_budget')->with('success', 'Orçamento criado com sucesso!');
    }
    public function pdf($id){
        $budget = Budget::findOrFail($id);
        $inventory = Inventory::all();
        $product = Product::all();
        $pdf = pdf::setOptions([
            'enable_remote' => true,
            'chroot'  => public_path(),
        ])->loadView('admin.budget.budgetPDF', compact('budget', 'inventory', 'product'));
        return $pdf->setPaper('a4')->stream("Orçamento nº $budget->id");
    }
    public function edit($id){

        $budget = Budget::findOrFail($id);
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();

        return view('admin.budget.edit',['budget' => $budget ,'inventory'=>$inventory, 'fpay'=>$fpay, 'cardTariff'=>$cardTariff]);
    }
    public function revert($id){
        $budget = Budget::findOrFail($id);
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();

        return view('admin.budget.revert',['budget' => $budget ,'inventory'=>$inventory, 'fpay'=>$fpay, 'cardTariff'=>$cardTariff]);
    }
    public function revertBudget($id){
        $budget = Budget::findOrFail($id);
        $sells = Sell::where('budget_id', $budget->id)->get();
        foreach($sells as $sell){
            if(isset($sell->product_1_id) && !empty($sell->product_1_id)){
                $inventory = Inventory::find($sell->product_1_id);
                $inventory->qtd += $sell->product_1_qtd;
                $inventory->update();
            }
            if(isset($sell->product_2_id) && !empty($sell->product_2_id)){
                $inventory = Inventory::find($sell->product_2_id);
                $inventory->qtd += $sell->product_2_qtd;
                $inventory->update();
            }
            if(isset($sell->product_3_id) && !empty($sell->product_3_id)){
                $inventory = Inventory::find($sell->product_3_id);
                $inventory->qtd += $sell->product_3_qtd;
                $inventory->update();
            }
            if(isset($sell->product_4_id) && !empty($sell->product_4_id)){
                $inventory = Inventory::find($sell->product_4_id);
                $inventory->qtd += $sell->product_4_qtd;
                $inventory->update();
            }
            if(isset($sell->product_5_id) && !empty($sell->product_5_id)){
                $inventory = Inventory::find($sell->product_5_id);
                $inventory->qtd += $sell->product_5_qtd;
                $inventory->update();
            }
            if(isset($sell->product_6_id) && !empty($sell->product_6_id)){
                $inventory = Inventory::find($sell->product_6_id);
                $inventory->qtd += $sell->product_6_qtd;
                $inventory->update();
            }
            if(isset($sell->product_7_id) && !empty($sell->product_7_id)){
                $inventory = Inventory::find($sell->product_7_id);
                $inventory->qtd += $sell->product_7_qtd;
                $inventory->update();
            }
            if(isset($sell->product_8_id) && !empty($sell->product_8_id)){
                $inventory = Inventory::find($sell->product_8_id);
                $inventory->qtd += $sell->product_8_qtd;
                $inventory->update();
            }
            if(isset($sell->product_9_id) && !empty($sell->product_9_id)){
                $inventory = Inventory::find($sell->product_9_id);
                $inventory->qtd += $sell->product_9_qtd;
                $inventory->update();
            }
            $sell->delete($sell->id);
        }
        $budget->status = 'Pendente';
        $budget->update();

        return redirect()->route('read_budget')->with('success', 'Orçamento revertido com sucesso!');
    }
    public function cancel($id){
        $budget = Budget::findOrFail($id);
        $budget->status = "Cancelado";
        $budget->update();

        return redirect()->route('read_budget')->with('success', 'Orçamento cancelado com sucesso!');
    }
    public function aproved($id, Request $request){
        $budget = Budget::findOrFail($id);
        $sell = new Sell;
        $sell->client = $budget->client;
        $sell->contact = $budget->contact; 
        $sell->product_1_id = $budget->product_1_id;
        $sell->product_1_qtd = $budget->product_1_qtd;
        if($budget->product_1_value){
            $sell->product_1_value = str_replace(",", ".", $budget->product_1_value);
        }else{
            $sell->product_1_value = 0.00;
        }
        $sell->product_2_id = $budget->product_2_id;
        $sell->product_2_qtd = $budget->product_2_qtd;
        if($budget->product_2_value){
            $sell->product_2_value = str_replace(",", ".", $budget->product_2_value);
        }else{
            $sell->product_2_value = 0.00;
        }
        $sell->product_3_id = $budget->product_3_id;
        $sell->product_3_qtd = $budget->product_3_qtd;
        if($budget->product_3_value){
            $sell->product_3_value = str_replace(",", ".", $budget->product_3_value);
        }else{
            $sell->product_3_value = 0.00;
        }
        $sell->product_4_id = $budget->product_4_id;
        $sell->product_4_qtd = $budget->product_4_qtd;
        if($budget->product_4_value){
            $sell->product_4_value = str_replace(",", ".", $budget->product_4_value);
        }else{
            $sell->product_4_value = 0.00;
        }
        $sell->product_5_id = $budget->product_5_id;
        $sell->product_5_qtd = $budget->product_5_qtd;
        if($budget->product_5_value){
            $sell->product_5_value = str_replace(",", ".", $budget->product_5_value);
        }else{
            $sell->product_5_value = 0.00;
        }
        $sell->product_6_id = $budget->product_6_id;
        $sell->product_6_qtd = $budget->product_6_qtd;
        if($budget->product_6_value){
            $sell->product_6_value = str_replace(",", ".", $budget->product_6_value);
        }else{
            $sell->product_6_value = 0.00;
        }
        $sell->product_7_id = $budget->product_7_id;
        $sell->product_7_qtd = $budget->product_7_qtd;
        if($budget->product_7_value){
            $sell->product_7_value = str_replace(",", ".", $budget->product_7_value);
        }else{
            $sell->product_7_value = 0.00;
        }
        $sell->product_8_id = $budget->product_8_id;
        $sell->product_8_qtd = $budget->product_8_qtd;
        if($budget->product_8_value){
            $sell->product_8_value = str_replace(",", ".", $budget->product_8_value);
        }else{
            $sell->product_8_value = 0.00;
        }
        $sell->product_9_id = $budget->product_9_id;
        $sell->product_9_qtd = $budget->product_9_qtd;
        if($budget->product_9_value){
            $sell->product_9_value = str_replace(",", ".", $budget->product_9_value);
        }else{
            $sell->product_9_value = 0.00;
        } 
        $sell->budget_id = $budget->id;
        $sell->fpay_id = $request->fpay_id;
        $sell->aprazo = $request->aprazo;
        $sell->date_pay = $request->date_pay;
        $sell->document = $request->document;
        $sell->description_service = $budget->description_service;
        $sell->price = str_replace(",", ".", $budget->price);
        $sell->labor = str_replace(",", ".", $budget->labor);
        $sell->discount = str_replace(",", ".", $budget->discount);
        $sell->tariff = $request->cardTariff;
        $sell->total = $sell->price + $sell->labor - $sell->discount;
        $sell->recebido = str_replace(",", ".", $request->recebido);
        $recebido = $sell->recebido;
        $total = $sell->total;
        if($sell->aprazo == true){
            $sell->status = "Pag. Pendente";
                if($request->fpay_id == 1){
                    $percentual =  $recebido * ($request->cardTariff / 100); 
                    $sell->recebido = $recebido - $percentual;
                    $sell->areceber = $sell->total - $request->recebido;
                }else{
                    $sell->recebido = $recebido;
                    $sell->areceber = $sell->total - $request->recebido;
                }
        }else{
            $sell->status = "Finalizado";
                if($request->fpay_id == 1){
                    $percentual =  $total * ($request->cardTariff / 100); 
                    $sell->total = $total - $percentual;
                    $sell->recebido = $sell->total;
                    $sell->areceber = 0;
                }else{
                    $sell->total = $total;
                    $sell->recebido = $sell->total;
                    $sell->areceber = 0;
                }
        }

        if(isset($sell->product_1_id) && !empty($sell->product_1_id)){
            $inventory = Inventory::find($sell->product_1_id);
            $inventory->qtd = $inventory->qtd - $sell->product_1_qtd;
            $inventory->update();
        }
        if(isset($sell->product_2_id) && !empty($sell->product_2_id)){
            $inventory = Inventory::find($sell->product_2_id);
            $inventory->qtd = $inventory->qtd - $sell->product_2_qtd;
            $inventory->update();
        }
        if(isset($sell->product_3_id) && !empty($sell->product_3_id)){
            $inventory = Inventory::find($sell->product_3_id);
            $inventory->qtd = $inventory->qtd - $sell->product_3_qtd;
            $inventory->update();
        }
        if(isset($sell->product_4_id) && !empty($sell->product_4_id)){
            $inventory = Inventory::find($sell->product_4_id);
            $inventory->qtd = $inventory->qtd - $sell->product_4_qtd;
            $inventory->update();
        }
        if(isset($sell->product_5_id) && !empty($sell->product_5_id)){
            $inventory = Inventory::find($sell->product_5_id);
            $inventory->qtd = $inventory->qtd - $sell->product_5_qtd;
            $inventory->update();
        }
        if(isset($sell->product_6_id) && !empty($sell->product_6_id)){
            $inventory = Inventory::find($sell->product_6_id);
            $inventory->qtd = $inventory->qtd - $sell->product_6_qtd;
            $inventory->update();
        }
        if(isset($sell->product_7_id) && !empty($sell->product_7_id)){
            $inventory = Inventory::find($sell->product_7_id);
            $inventory->qtd = $inventory->qtd - $sell->product_7_qtd;
            $inventory->update();
        }
        if(isset($sell->product_8_id) && !empty($sell->product_8_id)){
            $inventory = Inventory::find($sell->product_8_id);
            $inventory->qtd = $inventory->qtd - $sell->product_8_qtd;
            $inventory->update();
        }
        if(isset($sell->product_9_id) && !empty($sell->product_9_id)){
            $inventory = Inventory::find($sell->product_9_id);
            $inventory->qtd = $inventory->qtd - $sell->product_9_qtd;
            $inventory->update();
        }
        $sell->save();
        if($sell->save()){
            $budget->status = "Aprovado";
            $budget->update();
        }

        return redirect()->route('read_budget');
    }
}
