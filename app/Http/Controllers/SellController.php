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
        //validação
        $request->validate([
            'price' => 'required',
            'labor' => 'required',
            'discount' => 'required'
        ]);
        $sell = new Sell;
        // setando post no bd
        $sell->client = $request->client;
        $sell->contact = $request->contact; 
        $sell->product_1_id = $request->product_1_id;
        $sell->product_1_qtd = $request->product_1_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_1_value){
            $sell->product_1_value = str_replace(",", ".", $request->product_1_value);
        }else{
            $sell->product_1_value = 0.00;
        }
        $sell->product_2_id = $request->product_2_id;
        $sell->product_2_qtd = $request->product_2_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_2_value){
            $sell->product_2_value = str_replace(",", ".", $request->product_2_value);
        }else{
            $sell->product_2_value = 0.00;
        }
        $sell->product_3_id = $request->product_3_id;
        $sell->product_3_qtd = $request->product_3_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_3_value){
            $sell->product_3_value = str_replace(",", ".", $request->product_3_value);
        }else{
            $sell->product_3_value = 0.00;
        }
        $sell->product_4_id = $request->product_4_id;
        $sell->product_4_qtd = $request->product_4_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_4_value){
            $sell->product_4_value = str_replace(",", ".", $request->product_4_value);
        }else{
            $sell->product_4_value = 0.00;
        }
        $sell->product_5_id = $request->product_5_id;
        $sell->product_5_qtd = $request->product_5_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_5_value){
            $sell->product_5_value = str_replace(",", ".", $request->product_5_value);
        }else{
            $sell->product_5_value = 0.00;
        }
        $sell->product_6_id = $request->product_6_id;
        $sell->product_6_qtd = $request->product_6_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_6_value){
            $sell->product_6_value = str_replace(",", ".", $request->product_6_value);
        }else{
            $sell->product_6_value = 0.00;
        }
        $sell->product_7_id = $request->product_7_id;
        $sell->product_7_qtd = $request->product_7_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_7_value){
            $sell->product_7_value = str_replace(",", ".", $request->product_7_value);
        }else{
            $sell->product_7_value = 0.00;
        }
        $sell->product_8_id = $request->product_8_id;
        $sell->product_8_qtd = $request->product_8_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_8_value){
            $sell->product_8_value = str_replace(",", ".", $request->product_8_value);
        }else{
            $sell->product_8_value = 0.00;
        }
        $sell->product_9_id = $request->product_9_id;
        $sell->product_9_qtd = $request->product_9_qtd;
        // replace no decimal e em caso de nulo, seta 0
        if($request->product_9_value){
            $sell->product_9_value = str_replace(",", ".", $request->product_9_value);
        }else{
            $sell->product_9_value = 0.00;
        } 
        $sell->fpay_id = $request->fpay_id;
        $sell->aprazo = $request->aprazo;
        $sell->date_pay = $request->date_pay;
        $sell->document = $request->document;
        $sell->description_service = $request->description_service;
        $sell->price = str_replace(",", ".", $request->price);
        $sell->labor = str_replace(",", ".", $request->labor);
        $sell->discount = str_replace(",", ".", $request->discount);
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
        
        // abatendo quantidade de produtos do estoque
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

        return redirect()->route('sell')->with('success', 'Venda lançada com sucesso!');
    }
    public function totalsell(){
        $sell = Sell::orderBy('id', 'desc')->paginate(10);        
        $inventory = Inventory::all();
        $tariff = CardTariff::all();
        return view('admin.relatory.totalsell',['sell'=>$sell, 'inventory'=>$inventory, 'tariff'=>$tariff]);
    }
    public function finalizadassell(){
        $sell = Sell::where('status', '=', 'Finalizado')->orderBy('id', 'desc')->get();   
        $inventory = Inventory::all();
        $tariff = CardTariff::all();
        return view('admin.relatory.finalizadassell',['sell'=>$sell, 'inventory'=>$inventory, 'tariff'=>$tariff]);
    }
    public function pendentessell(){
        $sell = Sell::where('status', '=', 'Pag. Pendente')->orderBy('id', 'desc')->get();
        //$sell = Sell::orderBy('id', 'desc')->get();        
        $inventory = Inventory::all();
        $tariff = CardTariff::all();
        return view('admin.relatory.pendentessell',['sell'=>$sell, 'inventory'=>$inventory, 'tariff'=>$tariff]);
    }
    public function recebidosell(){
        $sell = Sell::where('recebido', '>', 0)->orderBy('id', 'desc')->get();        
        $inventory = Inventory::all();
        $tariff = CardTariff::all();
        return view('admin.relatory.recebidosell',['sell'=>$sell, 'inventory'=>$inventory, 'tariff'=>$tariff]);
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
    public function edit($id){
        $sell = Sell::findOrFail($id);
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();
        

        return view('admin.sell.editsell', compact('sell', 'inventory', 'fpay','cardTariff'));
    }
    public function reag($id){
        $sell = Sell::findOrFail($id);
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();
        

        return view('admin.sell.reagsell', compact('sell', 'inventory', 'fpay','cardTariff'));
    }
    public function parcial($id){
        $sell = Sell::findOrFail($id);
        $inventory = Inventory::all();
        $fpay = Fpay::all();
        $cardTariff = CardTariff::all();
        
        return view('admin.sell.parcial', compact('sell', 'inventory', 'fpay','cardTariff'));
    }
    public function updatestatus($id, Request $request){
        $sell = Sell::findOrFail($id);
        // setando as informação do update
        $sell->fpay_id = $request->fpay_id;
        $sell->tariff = $request->cardTariff;
        $sell->document = $request->document;
        $recebinput = str_replace(",", ".", $request->recebinput);
        $recebimento = $recebinput;
        if($request->fpay_id == 1){
            // calculando percentual
            $percentual =  $recebimento * ($request->cardTariff / 100); 
            // subtraindo o percentual
            $recebinput = $recebimento - $percentual;
            // ajustando valor a receber e setando o recebido
            $sell->areceber = $sell->areceber - $request->recebinput;
            $sell->recebido = $sell->recebido + $recebinput;
        }else{
            // ajustando valor a receber e setando o recebido
            $sell->areceber = $sell->areceber - $request->recebinput;
            $sell->recebido = $sell->recebido + $recebinput;
        }
        $sell->aprazo = false;
        $sell->status = "Finalizado";
        $sell->update();

        return redirect()->route('admin')->with('success', 'Recebimento finalizada!');
    }
    public function updatereag($id, Request $request){
        $sell = Sell::findOrFail($id);
        $request->validate([
            'date_pay' => 'required'
        ]);
        // atualizando a data de recebimento
        $sell->date_pay = $request->date_pay;
        $sell->update();

        return redirect()->route('admin')->with('success', 'Recebimento reagendado!');
    }
    public function updateparcial($id, Request $request){
        $sell = Sell::findOrFail($id);

        // validação
        $request->validate([
            'date_pay' => 'required',
            'fpay_id' => 'required'
        ]);
        //setando os updates
        $sell->date_pay = $request->date_pay;
        $sell->fpay_id = $request->fpay_id;
        $sell->tariff = $request->cardTariff;
        $sell->document = $request->document;
        $recebinput = str_replace(",", ".", $request->recebinput);
        $recebimento = $recebinput; 
        if($request->fpay_id == 1){
            // calculando percentual
            $percentual =  $recebimento * ($request->cardTariff / 100);
            // subtraindo o percentual
            $recebinput = $recebimento - $percentual;
            // ajustando valor a receber e setando o recebido
            $sell->areceber = $sell->areceber - $request->recebinput;
            $sell->recebido = $sell->recebido + $recebinput;
        }else{
            // ajustando valor a receber e setando o recebido
            $sell->areceber = $sell->areceber - $request->recebinput;
            $sell->recebido = $sell->recebido + $recebinput;
        }

        $sell->update();

        return redirect()->route('admin')->with('success', 'Recebimento atualizado com sucesso!');
    }
}
