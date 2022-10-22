<?php

namespace App\Http\Controllers;

use App\Models\Fpay;
use Illuminate\Http\Request;

class FpayController extends Controller
{
    public function fpay(){
        $fpay = Fpay::all();
        return view('admin.config.fpay', compact('fpay'));
    }
    public function store(Request $request){
        $fpay = new Fpay;
        $fpay->fpay = $request->fpay;
        $fpay->save();

        return redirect()->route('fpay')->with('success', 'Forma de recebimento criada com sucesso!');
    }
    public function destroy($id){
        Fpay::findOrFail($id)->delete();

        return redirect()->route('fpay')->with('success', 'Forma de recebimento excluida com sucesso!');
    }
}
