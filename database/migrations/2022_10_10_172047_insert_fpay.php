<?php

use App\Models\Fpay;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fpay = new Fpay(['fpay' => 'Cartão']);
        $fpay->save();
        $fpay2 = new Fpay(['fpay' => 'Dinheiro']);
        $fpay2->save();
        $fpay3 = new Fpay(['fpay' => 'Pix']);
        $fpay3->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
