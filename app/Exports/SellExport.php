<?php

namespace App\Exports;

use App\Models\CardTariff;
use App\Models\Fpay;
use App\Models\Inventory;
use App\Models\Sell;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SellExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.sell.sellexcel', [
            'sell' => Sell::all(),
            'inventory' => Inventory::all(),
            'fpay' => Fpay::all(),
            'tariff' => CardTariff::all(),
        ]);
    }
}
