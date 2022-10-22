<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        $selljan = Sell::whereMonth('created_at', "1")->get();
        $sellfev = Sell::whereMonth('created_at', "2")->get();
        $sellmar = Sell::whereMonth('created_at', "3")->get();
        $sellabr = Sell::whereMonth('created_at', "4")->get();
        $sellmai = Sell::whereMonth('created_at', "5")->get();
        $selljun = Sell::whereMonth('created_at', "6")->get();
        $selljul = Sell::whereMonth('created_at', "7")->get();
        $sellago = Sell::whereMonth('created_at', "8")->get();
        $sellset = Sell::whereMonth('created_at', "9")->get();
        $sellout = Sell::whereMonth('created_at', "10")->get();
        $sellnov = Sell::whereMonth('created_at', "11")->get();
        $selldez = Sell::whereMonth('created_at', "12")->get();

        $sell = Sell::all();
        $budget = Budget::all();
        
        
        return view('admin.admin', compact('budget', 'sell', 'selljan', 'sellfev', 'sellmar', 'sellabr', 'sellmai', 'selljun', 'selljul', 'sellago', 'sellset', 'sellout', 'sellnov', 'selldez'));
    }    
}
