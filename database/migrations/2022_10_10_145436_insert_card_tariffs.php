<?php

use App\Models\CardTariff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $card = new CardTariff(['name'=> 'Débito', 'percentual' => '0.9']);
        $card->save();
        $card1 = new CardTariff(['name'=> 'Credito - À vista', 'percentual' => '1.5']);
        $card1->save();
        $card2 = new CardTariff(['name'=> '2x', 'percentual' => '2']);
        $card2->save();
        $card3 = new CardTariff(['name'=> '3x', 'percentual' => '3']);
        $card3->save();
        $card4 = new CardTariff(['name'=> '4x', 'percentual' => '4']);
        $card4->save();
        $card5 = new CardTariff(['name'=> '5x', 'percentual' => '5']);
        $card5->save();
        $card6 = new CardTariff(['name'=> '6x', 'percentual' => '6']);
        $card6->save();
        $card7 = new CardTariff(['name'=> '7x', 'percentual' => '7']);
        $card7->save();
        $card8 = new CardTariff(['name'=> '8x', 'percentual' => '8']);
        $card8->save();
        $card9 = new CardTariff(['name'=> '9x', 'percentual' => '9']);
        $card9->save();
        $card10 = new CardTariff(['name'=> '10x', 'percentual' => '10']);
        $card10->save();
        $card11 = new CardTariff(['name'=> '11x', 'percentual' => '11']);
        $card11->save();
        $card12 = new CardTariff(['name'=> '12x', 'percentual' => '12']);
        $card12->save();
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
