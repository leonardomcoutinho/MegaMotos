<?php

namespace App\Http\Controllers;

use App\Models\CardTariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardTariffController extends Controller
{
    public function tariff(){
        $tariff = CardTariff::all();

        return view('admin.config.tariff', compact('tariff'));
    }
    public function edit($id){
        $tariff = CardTariff::findOrFail($id);

        return view('admin.config.edittariff', compact('tariff'));
    }
    public function update(Request $request){

        $tariff =  CardTariff::findOrFail($request->id);
        $tariff->percentual = $request->percentual; 
        $tariff->update();

        return redirect()->route('tariff');
    }
}
