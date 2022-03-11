<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormalisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normalisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prediction_dt_id')
                ->constrained('pred_datas')
                ->onDelete('cascade');
            $table->decimal('val_normalisasi', $precision = 30, $scale = 12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('normalisasi');
    }
}
